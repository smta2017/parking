<?php

namespace App\Repositories;

use App\Models\Transaction;
use App\Models\Zone;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    protected $fieldSearchable = [];

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

        $transaction = $this->create($request->all());

        return  $this->update(['plate_img' => $imageName], $transaction->id);
    }

    public function setCheckOut($qr_code)
    {
        return $this->update(['is_payed' =>  10, 'out_at' => Carbon::now()->toDateTimeString()], $qr_code);
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
        return $this->all($filter, null, 50)->sortByDesc('updated_at');
    }

    public function currentDayCollected()
    {
        $total_day_profit = Transaction::whereDate('created_at', Carbon::today())->sum('is_payed');
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
        $total_transaction_count = Transaction::count();
        $total_inside = Transaction::whereNull('out_at')->count();
        return $total_transaction_count - $total_inside;
    }

    public function available()
    {
        $inside = $this->totalReserved();
        return Zone::zoneCapacity() - $inside;
    }

    public function reserved_persntage()
    {
        return \round(($this->totalReserved() / Zone::zoneCapacity()) * 100, 0);
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
        ];
    }
}
