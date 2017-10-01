<?php
namespace EmploiyerBundle\Twig;
use Symfony\Component\HttpFoundation\Request;
class JngExtension extends \Twig_Extension {
    /**
     *
     * @var type
     */
    protected $request;
    /**
     *
     * @var \Twig_Environment
     */
    protected $environment;
    /**
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     */
    public function __construct(Request $request) {
        $this->request = $request;
    }
    /**
     *
     * @param \Twig_Environment $environment
     */
    public function initRuntime(\Twig_Environment $environment) {
        $this->environment = $environment;
    }



    public function getFilters()
    {
        return array(
            'diffToDate' => new \Twig_Filter_Method($this, 'diffToDateFilter'),
        );
    }

    public function diffToDateFilter($date1, $date2, $unit=null )
    {
        if( is_null($date2) )
            return;

        $t = $date2->getTimestamp()-$date1->getTimestamp();
        if( is_null($unit) ){
            $unit="s";
            if( $t >= 3600)
                $unit = "h";
            else if( $t >= 60)
                $unit = "min";
        }

        if( $unit == "s" )
            return $t." s";
        else if( $unit == "min" )
            return round($t/60)." min";
        else if( $unit == "h" )
            return round($t/3600)." h";

    }

    public function getName()
    {
        return 'jng_extension';
    }

}