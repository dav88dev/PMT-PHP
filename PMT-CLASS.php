<?php
// PMT calculation class
// Author: Davit Aghayan   TheMaster

class PMT {

    /**
     * The present value, or the total amount that a series of future payments is worth now; also known as the principal.
     *
     * @var $loan float
     */
    private $loan;

    /**
     * The total number of payments for the loan.
     *
     * @var $month integer
     */
    private $month;

    /**
     * Rate -   The interest rate for the loan.
     *
     * @var $interest float
     */
    private $interest;

    /**
     * Rate -  Optional. The future value,
     * or a cash balance you want to attain after the last payment is made.
     * If fv is omitted, it is assumed to be 0 (zero),
     * that is, the future value of a loan is 0.
     *
     * @var $left_open float
     */
    private $left_open;

    
    /**
     * Checking PHP version, script compatible with PHP version 7.0 or higher
     */
    public function __construct() {

        if (version_compare(PHP_VERSION, '7.0.0', '<')) {

            throw new Exception('PHP version 7.0 or higher accepted');
        }

    }


    /**
     * Set required properties
     * @param  float   $loan  loan
     * @param  integer $month month
     * @param  float   $interest interest
     * @param  float   $left_open  optional
     * @return void
     */
    public function setValues(float $loan,int $month,float $interest, float $left_open=0):void {

            $this->loan= $loan;
            $this->month=  $month;
            $this->interest= $interest;
            $this->left_open= $left_open;
    }


    /**
     * Get result
     * @return float
     */
    public function getResult():float {

        //number >>> english notation without thousands separator
        return number_format($this->calculation(), 2, '.', '');  
    }


    /**
     * Calculate PMT
     * @return float
     */
    private  function calculation():float {
        
        $interest = $this->interest / 1200;

        return  ($interest * (-($this->loan) * pow((1 + $interest), $this->month) + $this->left_open) / (1 - pow((1 + $interest), $this->month)));

    }

}


$pmt = new PMT();

$pmt->setValues(10000, 24, 5, 1000);

var_dump($pmt->getResult());


?>
