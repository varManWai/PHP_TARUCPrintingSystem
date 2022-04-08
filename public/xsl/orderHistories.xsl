<!-- Author:ChanOwen -->
<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:template match="/">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />

    <!-- CSS  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"/>
    <link rel="stylesheet" type="text/css" href="css/print.css" media="print"/>
  </head>
<body>

<div class="container">
    <div class="row justify-content-center">
    
        <div class="col-md-8 mt-5">
        
            <h1 class="text-center mb-5">Order History</h1>
        
        <table class="table table-success table-striped table-bordered border-success">
        
        <thead>
            <tr>
                <th scope="col" class="text-center">Order ID</th>
                <th scope="col" class="text-center">Date</th>
                <th scope="col" class="text-center">Total Price</th>
                <th scope="col" class="text-center">Status</th>
                <th scope="col" class="text-center">Pick Up Method</th>
            </tr>
        </thead>
        <tbody>
        <xsl:for-each select="/orderHistories/orderHistory">
            <tr>
            <th scope="row" class="text-center"><xsl:value-of select="orderID"/></th>
            <td class="text-center"><xsl:value-of select="date"/></td>
            <td class="text-center">RM<xsl:value-of select="totalPrice"/></td>
            <td class="text-center"><xsl:value-of select="status"/></td>
            <td class="text-center"><xsl:value-of select="pickUpMethod"/></td>
            </tr>
        </xsl:for-each>
        </tbody>
    </table>
        </div>
        <div class="text-center">
                    <button onclick="window.print();" class="btn btn-primary" id="print-btn">Print</button>
        </div>
    </div>
</div>


    

</body>
</html>
</xsl:template>
</xsl:stylesheet>