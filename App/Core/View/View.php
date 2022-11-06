<?php

namespace App\Core\View;

class View
{

    public static function render(string $name, array $data)
    {
        header('Content-type: text/html');
        try {
            $template = $_SERVER['DOCUMENT_ROOT'] . '/App/View/' . $name . '.php';

            if (!is_file($template)) {
                throw new \RuntimeException('Template not found: ' . $template);
            }

            // define a closure with a scope for the variable extraction
            $result = function ($template, array $data) {
                //ob_start();
                extract($data, EXTR_SKIP);

                try {
                    include $template;
                } catch (\Exception $e) {
                    ob_end_clean();
                    throw $e;
                }
                return ob_get_clean();
            };

            // call the closure
            return $result($template, $data);
        } catch (\Exception $exception) {
            var_dump($exception);
        }
    }

}