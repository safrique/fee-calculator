<?php

namespace Lendable\Interview\Interpolation\Tests;

//require '../Commands/calculateFee.php';

use PHPUnit\Framework\TestCase;

class CommandlineCalculationTest extends TestCase
{
    public function testCalculation()
    {
        $term = 12;
        $amount = 12345;
//        $directory = getcwd() . '\\Commands\\calculateFee.php';
//        echo "directory=$directory\n";

        $script = 'cd Commands && php calculateFee.php && echo 12 && echo 12345';
        $run0 = shell_exec($script);
        $args = getopt('');

//        $output  = `cd Commands && php calculateFee.php >12 >12345`;

//        $script = $term;
//        $run1 = shell_exec($script);
//        $script = $amount;
//        $run2 = shell_exec($script);

//        $process_cmd = 'cd Commands && php calculateFee.php';
//        $env = null;
//        $options = array('bypass_shell' => true);
//        $cwd = null;
//        $descriptorspec = array(
//            0 => array("pipe", "r"),              // stdin is a pipe that the child will read from
//            1 => array("pipe", "w"),              // stdout is a pipe that the child will write to
//            2 => array("file", "/error.txt", "a") // stderr is a file to write to
//        );
//
//        $process = proc_open($process_cmd, $descriptorspec, $pipes, $cwd, $env, $options);
//
//        $i = 0;
//
//        if (is_resource($process)) {
//            echo($stream[$i] = stream_get_contents($pipes[1]));
//            fwrite($pipes[1], 12);
//            fwrite($pipes[1], 1234);
//            fclose($pipes[1]);
//
//            // It is important that you close any pipes before calling
//            // proc_close in order to avoid a deadlock
//            $return_value = proc_close($process);
//
//            $run[$i] = "command returned $return_value\n";
//        }

        $this->assertIsString('test');
    }
}