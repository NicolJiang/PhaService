<?php

use JakubOnderka\PhpConsoleColor\ConsoleColor;

/**
 * Base task
 */
class TaskBase extends \Phalcon\Cli\Task
{
    const APP_SERVICE_NAME = "PhaServiceTask";

    public $consoleColor;

    /**
     * initialize
     */
    public function initialize()
    {
        $this->consoleColor = new ConsoleColor();
    }//end


    /**
     * Console Color Print
     *
     * @param string $text
     * @param string $styles
     * @param bool   $newLine
     */
    public function cout(string $text, string $styles = 'f255', $newLine = FALSE)
    {
        $_style = [];
        if ('f255' == $styles) {
            $_style[] = 'color_255';
        } else {
            $styleAr = explode(',', $styles);
            foreach ($styleAr as $style) {
                $style = trim($style);
                if ($style{0} == 'f' && is_numeric($style{1})) {
                    $_style[] = 'color_' . substr($style, 1);
                } elseif ($style{0} == 'b' && is_numeric($style{1})) {
                    $_style[] = 'bg_color_' . substr($style, 1);
                } else {
                    $_style[] = $style;
                }
            }
        }
        echo $this->consoleColor->apply($_style, $text);
        if (TRUE == $newLine) echo PHP_EOL;
    }//end


}//end
