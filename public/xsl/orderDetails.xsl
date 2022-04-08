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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </head>
<body>
    <div class="container">
        <h1 class="text-center pt-5">Order Details</h1>

        <xsl:for-each select="/orderDetails/SubjectDetail">
        <div class="row ">  
        <div class="col-3 ">
        </div>     
            <div class="col-6 border-bottom border-top">
            <p>Title: <xsl:value-of select="subjectTitle"/></p>
            <p>Pages: <xsl:value-of select="subjectPages"/></p>
            <p>Quantity: <xsl:value-of select="Qty"/></p>
            <p>Sub-total: RM<xsl:value-of select="subjectTotal"/></p>
            </div>
        <div class="col-3">
        </div>  
        </div>
        </xsl:for-each>
        <div class="row pt-5">
        <div class="col-3 ">
        </div> 
        <div class="col-6 ">
            <p>Total Price: RM<xsl:value-of select="/orderDetails/TotalPrice"/></p>
            <xsl:element name="a">
                <xsl:attribute name="href">
                    <xsl:text>/paymentBtn/</xsl:text><xsl:value-of select="/orderDetails/TotalPrice"/>
                </xsl:attribute>
                <xsl:attribute name="class">
                <xsl:text>btn btn-primary</xsl:text>
                </xsl:attribute>
                <xsl:text>Proceed to Payment</xsl:text>
            </xsl:element>
            <span class="px-2"></span>
            <xsl:element name="a">
                <xsl:attribute name="href">
                    <xsl:text>/cart</xsl:text>
                </xsl:attribute>
                <xsl:attribute name="class">
                <xsl:text>btn btn-primary</xsl:text>
                </xsl:attribute>
                <xsl:text>Cancel</xsl:text>
            </xsl:element>
        </div> 
        <div class="col-3 ">
        </div> 
        </div>
    </div>
    
</body>
</html>
</xsl:template>
</xsl:stylesheet>