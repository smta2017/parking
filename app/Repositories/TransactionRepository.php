<?php

namespace App\Repositories;

use App\Models\Transaction;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * Class TransactionRepository
 * @package App\Repositories
 * @version March 17, 2022, 10:23 pm UTC
 */

class TransactionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'plate_number',
        'plate_img',
        'mobile',
        'driver_name',
        'out_at',
        'qr_code',
        'is_bayed',
        'zone_id',
        'created_by'
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


    public function setCheckIn(array $input = [])
    {
        $input["created_by"] = auth()->user()->id;
        $input["zone_id"] = auth()->user()->zone_id;

        return $this->create($input);
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
        return $this->all($filter, null, 50)->sortBy('updated_at');
    }
}
