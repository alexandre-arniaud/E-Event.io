<?php
class File {
    public static function build_path($path_array) {
        $ROOT_FOLDER = __DIR__ . DIRECTORY_SEPARATOR . "..";
        return $ROOT_FOLDER. '/' . join('/', $path_array);
    }

}