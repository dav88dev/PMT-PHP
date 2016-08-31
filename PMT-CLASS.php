<?php
// PMT calculation class
// Author: Davit Aghayan   davitdeveloper

class PMT {

    protected $loan;
    protected $month;
    protected $interest;
    protected $left_open;
    public $result;
    function __construct($loan,$month, $interest,  $left_open=0)
    {


        if(func_num_args()<3 or func_num_args() > 4){

            die("Something went wrong");

        }

        else {


            $this->loan= (float) $loan;
            $this->month= (int) $month;
            $this->interest=(float) $interest;
            $this->left_open=(float) $left_open;
	    $this->result= SELF::calculation($interest, $month, $loan, $left_open);
        }
    }



    private  function calculation($interest, $month, $loan, $left_open)
    {
        $month = $month;
        $interest = $interest / 1200;
        $amount = $interest * (-$loan * pow((1 + $interest), $month) + $left_open) / (1 - pow((1 + $interest), $month));
        return number_format($amount, 2, '.', '');  //number >>> english notation without thousands separator
    }

}



$loan=10000; // Required. The present value, or the total amount that a series of future payments is worth now; also known as the principal. 
$month=24; // Required. The total number of payments for the loan.
$interest=5;  // Required. Rate -  Required. The interest rate for the loan.
$left_open=1000; //    Optional. The future value, or a cash balance you want to attain after the last payment is made. If fv is omitted, it is assumed to be 0 (zero), that is, the future value of a loan is 0.

$objct = new PMT($loan, $month, 5, $left_open);

echo $objct->result;

?>
