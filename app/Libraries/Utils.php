<?php namespace App\Libraries;

use App\Models\Product;

class Utils {

    public static function countProducts($category_id)
    {
        $products = Product::where('category', $category_id)->count();
        return $products;
    }

    public static function getCustomerStatusDisplayName($id) {
        if ( $id == 1 ) {
            return 'Active';
        } else {
            return 'non-Active';
        }
    }

    public static function getCustomerTypeDisplayName($type) {
        if ( $type == 1 ) {
            return 'Licensed BO Partner';
        } elseif ( $type == 2 ) {
            return 'Official Agent';
        } elseif ( $type == 3 ) {
            return 'Free Agent';
        } elseif ( $type == 4 ) {
            return 'Regular Customer';
        } elseif ( $type == 5 ) {
            return 'Distributor';
        } elseif ( $type == 6 ) {
            return 'Genuine BO Partner';
        } elseif ( $type == 7 ) {
            return 'Investor';
        } elseif ( $type == 8 ) {
            return 'Trainee';
        } else {
            return 'unknown';
        }
    }

    public static function date($date) {
        if ($date != 000-00-00 && $date != null) {
            $dt = \Carbon\Carbon::parse($date);
            return $dt->format('d F');
        }
        return false;
    }

    public static function reggo($price){
        $length = strlen($price);

        switch($length){
          case "1":
            $pecah = substr(@$price, -1);
            $write = "Rp ".$pecah.",-";
          break;
          case "2":
            $pecah = substr(@$price, -2);
            $write = "Rp ".$pecah.",-";
          break;
          case "3":
            $pecah = substr(@$price, -3);
            $write = "Rp ".$pecah.",-";
          break;
          case "4":
            $pecah = substr(@$price, -3);
            $pecah2 = substr(@$price, -4, 1);
            $write = "Rp ".$pecah2.".".$pecah.",-";
          break;
          case "5":
            $pecah = substr(@$price, -3);
            $pecah2 = substr(@$price, -5, 2);
            $write = "Rp ".$pecah2.".".$pecah.",-";
          break;
          case "6":
            $pecah = substr(@$price, -3);
            $pecah2 = substr(@$price, -6, 3);
            $write = "Rp ".$pecah2.".".$pecah.",-";
          break;
          case "7":
            $pecah = substr(@$price, -3);
            $pecah2 = substr(@$price, -6, 3);
            $pecah3 = substr(@$price, -7, 1);
            $write = "Rp ".$pecah3.".".$pecah2.".".$pecah.",-";
          break;
          case "8":
            $pecah = substr(@$price, -3);
            $pecah2 = substr(@$price, -6, 3);
            $pecah3 = substr(@$price, -8, 2);
            $write = "Rp ".$pecah3.".".$pecah2.".".$pecah.",-";
          break;
          case "9":
            $pecah = substr(@$price, -3);
            $pecah2 = substr(@$price, -6, 3);
            $pecah3 = substr(@$price, -9, 3);
            $write = "Rp ".$pecah3.".".$pecah2.".".$pecah.",-";
          break;
          case "10":
            $pecah = substr(@$price, -3);
            $pecah2 = substr(@$price, -6, 3);
            $pecah3 = substr(@$price, -9, 3);
            $pecah4 = substr(@$price, -10, 1);
            $write = "Rp ".$pecah4.".".$pecah3.".".$pecah2.".".$pecah.",-";
          break;
          case "11":
            $pecah = substr(@$price, -3);
            $pecah2 = substr(@$price, -6, 3);
            $pecah3 = substr(@$price, -9, 3);
            $pecah4 = substr(@$price, -11, 2);
            $write = "Rp ".$pecah4.".".$pecah3.".".$pecah2.".".$pecah.",-";
          break;
          case "12":
            $pecah = substr(@$price, -3);
            $pecah2 = substr(@$price, -6, 3);
            $pecah3 = substr(@$price, -9, 3);
            $pecah4 = substr(@$price, -12, 3);
            $write = "Rp ".$pecah4.".".$pecah3.".".$pecah2.".".$pecah.",-";
          break;
        }
        return @$write;

    }

}
