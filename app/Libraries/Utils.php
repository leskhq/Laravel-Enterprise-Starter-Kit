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

    public static function getCustomerTypeDisplayName($id) {
        if ( $id == 1 ) {
            return 'Mitra BO Lisensi';
        } elseif ( $id == 2 ) {
            return 'Agen Resmi';
        } elseif ( $id == 3 ) {
            return 'Agen Lepas';
        } elseif ( $id == 4 ) {
            return 'Customer Biasa';
        } elseif ( $id == 5 ) {
            return 'Distributor';
        } elseif ( $id == 6 ) {
            return 'Mitra BO Murni';
        } elseif ( $id == 7 ) {
            return 'Investor';
        } elseif ( $id == 8 ) {
            return 'Peserta Pelatihan';
        } else {
            return 'unknown';
        }
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
