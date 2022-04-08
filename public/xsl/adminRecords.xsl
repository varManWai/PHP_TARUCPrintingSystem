<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:template match="/">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />

    <!-- CSS  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"/>
    
  </head>
<body>

    <div id="app">
        <div class="container">
            <div class="row justify-content-center">
                <h2 class="text-center my-4">All User Accounts</h2>
            </div>
            <div class="row justify-content-center">               
                <div class="col-md-10 ">
                    <div class="card mt-3">
                        <div class="card-header ">Admins Account Management</div>
                       
                            <div class="card-body table-responsive-xl">
                                <table class="table  table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-center">ID</th>
                                            <th scope="col" class="text-center">Name</th>
                                            <th scope="col" class="text-center">Email</th>
                                            <th scope="col" class="text-center">Phone No</th>
                                            <th scope="col" class="text-center">Created_at</th>
                                            <th scope="col" class="text-center">Updated_at</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <xsl:for-each select="root/admins">
                                        <tr>
                                        <th scope="row" class="text-center"><xsl:value-of select="id"/></th>
                                        <td class="text-center"><xsl:value-of select="name"/></td>
                                        <td class="text-center"><xsl:value-of select="email"/></td>
                                        <td class="text-center"><xsl:value-of select="phoneNo"/></td>
                                        <td class="text-center"><xsl:value-of select="created_at"/></td>
                                        <td class="text-center"><xsl:value-of select="updated_at"/></td>
                                        </tr>
                                    </xsl:for-each>
                                    </tbody>
                                </table>
                            </div>
                      
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
</xsl:template>
</xsl:stylesheet>