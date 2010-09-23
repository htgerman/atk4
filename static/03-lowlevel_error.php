<?
if(!function_exists('lowlevel_error')){
    // sometimes i wonder, who called some specific function. Now you can find out
    // caller_lookup relies on backtrack info to pull out into about caller class
    function caller_lookup($shift=0,$file=false){
        // This function will filter only keys/values from hash which are
        // in allowed_keys as well.
        $bt=debug_backtrace();
        $shift+=3;
        @$r=(
                ($file?$bt[$shift]['file'].":".$bt[$shift]['line'].":":"").
                $bt[$shift]['class'].
                $bt[$shift]['type'].
                $bt[$shift]['function']);
        return $r;
    }
    function lowlevel_error($error,$lev=null){
        /*
         * This function will be called for low level fatal errors
         */
        if(isset($_SERVER)){
            echo "<font color=red>Low level error:</font> $error in <b>".caller_lookup()."()</b><br><br>Backtrace:<pre>";
        }else{
            echo "================================\n** Low level error: $error in ".caller_lookup()."()\nBacktrace:\n";
        }
        $backtrace=print_r(debug_backtrace(),true);
        // restricting output by X symbols
        $x=1024; //1k
        if(strlen($backtrace)>$x)$backtrace=substr($backtrace,0,$x).
            "<br>... Backtrace is too long, trimmed to first $x symbols ...";
        echo $backtrace;
        exit;
    }
}

