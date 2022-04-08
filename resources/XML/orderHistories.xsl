<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:template match="/">
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <title>Order History</title>
</head>
<body>
    <table>
        
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
                <td class="text-center"><xsl:value-of select="totalPrice"/></td>
                <td class="text-center"><xsl:value-of select="date"/></td>
                <td class="text-center"><xsl:value-of select="status"/></td>
                <td class="text-center"><xsl:value-of select="pickUpMethod"/></td>
            </tr>
        </xsl:for-each>
        </tbody>
    </table>
</body>
</html>
</xsl:template>
</xsl:stylesheet>