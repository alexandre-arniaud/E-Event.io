<?php
class File {
    public static function build_path($path_array) {
        $ROOT_FOLDER = "..";
        return $ROOT_FOLDER. '/' . join('/', $path_array);
    }

}