<?php

namespace App\Repositories;

use App\Models\Transaction;
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
    protected $fieldSearchable = [
        
    ];

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
        return $this->update(['out_at' => Carbon::now()->toDateTimeString()], $qr_code);
    }

    public function getTransactionCart()
    {
        // $transaction = Transaction::orderBy('updated_at')->get();

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
}
