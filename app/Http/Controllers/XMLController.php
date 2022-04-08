<?php
// Author:Lai Man Wai 

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Admin;
use App\Models\Supplier;

use Spatie\ArrayToXml\ArrayToXml;

class XMLController extends Controller
{

    public function displayXML()
    {
        
        $users = User::all()->toArray();
        $users = [
            'users' => [
                [$users]
            ],
        ];

        $admins = Admin::all()->toArray();
        $admins = [
            'admins' => [
                [$admins]
            ],
        ];

        $suppliers = Supplier::all()->toArray();
        $suppliers = [
            'suppliers' => [
                [$suppliers]
            ],
        ];

        
        $xml1 = new \DOMDocument();
        $xml1->loadXML(ArrayToXml::convert($admins));

        $xml2 = new \DOMDocument();
        $xml2->loadXML(ArrayToXml::convert($suppliers));
        
        $xml3 = new \DOMDocument();
        $xml3 ->loadXML(ArrayToXml::convert($users));

        $xsl1 = new \DOMDocument();
        $xsl1->load('xsl\adminRecords.xsl');
        
        $xsl2 = new \DOMDocument();
        $xsl2->load('xsl\supplierRecords.xsl');
        
        $xsl3 = new \DOMDocument();
        $xsl3->load('xsl\userRecords.xsl');


        $proc1 = new \XSLTProcessor();
        $proc1 -> importStyleSheet($xsl1);

        $proc2 = new \XSLTProcessor();
        $proc2 -> importStyleSheet($xsl2);

        $proc3 = new \XSLTProcessor();
        $proc3 -> importStyleSheet($xsl3);

        echo $proc1->transformToXML($xml1);
        echo $proc2->transformToXML($xml2);
        echo $proc3->transformToXML($xml3);
    }
}