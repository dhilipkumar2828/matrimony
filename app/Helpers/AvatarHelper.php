<?php
namespace App\Helpers;

class AvatarHelper {
    public static function getAvatar($gender, $prefix = '') {
        $g = strtolower(trim($gender));
        if ($g == "male" || $g == "groom") {
            return $prefix . "assets/avatar/male-avatar.svg";
        } else {
            return $prefix . "assets/avatar/female-avatar.svg";
        }
    }
}
?>
