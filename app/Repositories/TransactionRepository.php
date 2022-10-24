<?php

namespace App\Repositories;

use App\Models\Transaction;
use App\Models\Zone;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

/**
 * Class TransactionRepository
 * @package App\Repositories
 * @version May 22, 2022, 4:08 pm UTC
 */

class TransactionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = ['customer_id', 'type'];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Transaction::class;
    }


    public function setCheckIn(Request $request)
    {
        $imageName = time() . '.' . $request->plate_img->extension();
        $request->plate_img->move(storage_path('app/public/images/plate'), $imageName);

        $request["created_by"] = auth()->user()->id;
        $request["zone_id"] = auth()->user()->zone_id;

        $request["customer_id"] = env('DEFAULT_CLIENT', 2);
        $request["type"] = Transaction::GENERAL_TRANSACTION;

        $transaction = $this->create($request->all());

        return  $this->update(['plate_img' => $imageName], $transaction->id);
    }

    public function setCheckInOvernight(Request $request)
    {
        $imageName = time() . '.' . $request->plate_img->extension();
        // $request->plate_img->storeAs('/images/plate', $imageName, env('FILESYSTEM_DRIVER'));
        $request->plate_img->move(storage_path('app/public/images/plate'), $imageName);

        // Storage::disk('s3')->put('images/plate', $request->plate_img);

        $use = auth()->user();

        $request["created_by"] = auth()->user()->id;
        $request["zone_id"] = auth()->user()->zone_id;

        $request["customer_id"] = env('DEFAULT_CLIENT', 2);
        $request["type"] = Transaction::OVERNIGHT_TRANSACTION;

        $transaction = $this->create($request->all());

        return  $this->update(['plate_img' => $imageName], $transaction->id);
    }



    public function setCheckOutOvernight($qr_code)
    {
        session(['session_zone_id' => auth()->user()->zone_id]);
        $day = 12;
        $transaction = Transaction::find($qr_code);

        if ($transaction->type != 3) {
            return \response()->json(['succsess' => false, 'message' => 'invalid transaction type']);
        }

        $second_hour_rate = Zone::secondHourRate();
        $overnightRate = Zone::overnightRate();
        $total_hors =  $transaction->created_at->diffInHours($transaction->out_at, false);
        $extra_hors = (($total_hors - $day) >= 0) ? $total_hors - $day : 0;
        $total_amount =  ($second_hour_rate * $extra_hors) + $overnightRate;
        return $this->update(['is_payed' =>  $total_amount, 'out_at' => Carbon::now()->toDateTimeString(), 'out_by' => auth()->user()->id], $transaction->id);
    }


    public function setCheckInClient($vehicle)
    {
        // $imageName = time() . '.' . $request->plate_img->extension();
        // $request->plate_img->move(storage_path('app/public/images/plate'), $imageName);
        $request = [];
        $request["created_by"] = auth()->user()->id;
        $request["zone_id"] = auth()->user()->zone_id;

        $request["customer_id"] = $vehicle;
        $request["type"] = Transaction::SUBSCRIBE_TRANSACTION;

        $transaction = $this->create($request);

        return $transaction;
        // $this->update(['plate_img' => $imageName], $transaction->id);
    }

    public function setCheckOut($qr_code)
    {
        session(['session_zone_id' => auth()->user()->zone_id]);
        $transaction = Transaction::find($qr_code);
        if ($transaction->type != 1) {
            return \response()->json(['succsess' => false, 'message' => 'invalid transaction type']);
        }
        $hour_rate = Zone::hourRate();
        $second_hour_rate = Zone::secondHourRate();
        $total_hors =  $transaction->created_at->diffInHours($transaction->out_at, false);
        $total_amount = ($second_hour_rate * $total_hors) + $hour_rate;
        return $this->update(['is_payed' =>  $total_amount, 'out_at' => Carbon::now()->toDateTimeString(), 'out_by' => auth()->user()->id], $transaction->id);
    }

    public function setCheckOutClient($customer_id)
    {
        session(['session_zone_id' => auth()->user()->zone_id]);
        $transaction = Transaction::subscribe()->where('customer_id', $customer_id)->first();

        if ($transaction->type != 2) {
            return \response()->json(['succsess' => false, 'message' => 'invalid transaction type']);
        }

        $hour_rate = Zone::hourRate();
        $second_hour_rate = Zone::secondHourRate();
        $total_hors =  $transaction->created_at->diffInHours($transaction->out_at, false);
        $total_amount = ($second_hour_rate * $total_hors) + $hour_rate;
        return $this->update(['is_payed' =>  $total_amount, 'out_at' => Carbon::now()->toDateTimeString(), 'out_by' => auth()->user()->id], $transaction->id);
    }

    public function setCheckOutByPlate($plate)
    {
        $transaction = Transaction::where('plate_number', $plate)->first();
        $transaction->out_at = Carbon::now()->toDateTimeString();
        $transaction->is_payed = 10;
        $transaction->update();
        return $transaction;
    }


    public function setActualCollect(Request $request)
    {
        return $this->update(['is_payed' => $request['collected']], $request['qr_code']);
    }

    public function getTransactionCart()
    {

        $transaction = Transaction::select(DB::raw('count(*) as orders, DATE(created_at) day'))
            ->groupBy('day')
            ->orderBy('day')
            // ->limit(10)
            ->get();
        return $transaction;
    }


    public function latestTransactions($filter = [])
    {
        return $this->all($filter, null, null)->sortByDesc('updated_at');
    }

    public function currentDayCollected()
    {
        $total_day_profit = Transaction::where('type','<>', Transaction::SUBSCRIBE_TRANSACTION)->whereDate('out_at', Carbon::today())->sum('is_payed');
        return $total_day_profit;
    }

    public function currentDayCheckInCount()
    {
        $check_in_count = Transaction::whereDate('created_at', Carbon::today())->count();
        return $check_in_count;
    }

    public function currentDayCheckOutCount()
    {
        $check_out_count = Transaction::whereDate('out_at', Carbon::today())->count();
        return $check_out_count;
    }
    public function totalReserved()
    {
        $total_inside = Transaction::whereNull('out_at')->count();
        return $total_inside;
    }

    public function currentDayOvernight()
    {
        $total_overnight = Transaction::whereDate('created_at', Carbon::today())->whereType(Transaction::OVERNIGHT_TRANSACTION)->count();
        return $total_overnight;
    }

    public function currentDaySubscribe()
    {
        $total_subscribe = Transaction::whereDate('created_at', Carbon::today())->whereType(Transaction::SUBSCRIBE_TRANSACTION)->count();
        return $total_subscribe;
    }
    public function available()
    {
        $avilable = Zone::zoneCapacity() - $this->totalReserved();
        return $avilable;
    }

    public function reserved_persntage()
    {
        if (Zone::zoneCapacity()) {
            return \round(($this->totalReserved() / Zone::zoneCapacity()) * 100, 0);
        }
        return 0;
    }

    public function dashboardInfo()
    {
        return [
            'current_day_collected' => $this->currentDayCollected(),
            'current_day_checkIn_count' => $this->currentDayCheckInCount(),
            'current_day_checkOut_count' => $this->currentDayCheckOutCount(),
            'capacity' => Zone::zoneCapacity(),
            'available' => $this->available(),
            'total_reserved' => $this->totalReserved(),
            'reserved_persntage' => $this->reserved_persntage(),
            'current_day_overnight' => $this->currentDayOvernight(),
            'current_day_subscribe' => $this->currentDaySubscribe(),

            // عدد الزائرين

            // عدد المشتركين

            // أشتراكات منتهيه

            // أشتراكات محظوره

            // أشتركات قيد التفعيل
        ];
    }

    public function moneyTransactions(Request $filter,$type=1)
    {
        if(!$filter->has('thedate')){
            $filter->thedate=date('yy/mm/dd');//'2022/10/24';
        }

        return Transaction::where('type', $type)->whereDate('created_at', $filter->thedate)->get();
    }
    public function sayesCollect()
    {
        // return Transaction::find(50);
        return Transaction::where('zone_id', session('session_zone_id'))->whereNotNull('out_at')->get();
        // return Transaction::select('out_by', DB::raw('sum(is_payed) as total'))
        //     ->whereNotNull('out_at')
        //     ->where('zone_id', session('session_zone_id'))
        //     ->groupBy('out_by')
        //     ->get();
    }
}
