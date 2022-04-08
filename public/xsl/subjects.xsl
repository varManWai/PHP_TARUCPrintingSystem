<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<!--
author: Ho Wai Kit
-->
<xsl:template match="/">
<html>
<body>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />
    <title>Subjects in XML</title>

    <!-- CSS  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
    <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection" />
  </head>
  <nav class="red darken-4" role="navigation">
      <div class="nav-wrapper container"></div>
  </nav>
  <div class="container">
    <h1 class="text-center">Lists of subjects available (XML)</h1>
    <div class="row center">
    <table class="table table-striped">
      <thead >
        <tr>        
          <th scope="row">ID</th>
          <th scope="row">Course Code</th>
          <th scope="row">Title</th>
          <th scope="row">Pages</th>
          <th scope="row">Price (RM)</th>
          <th scope="row">Image</th>
        </tr>
      </thead>
            
      <xsl:for-each select="/subjects/subject">               
      <tbody>
        <tr>
          <td><xsl:value-of select="subjectID" /></td>
          <td><xsl:value-of select="courseCode" /></td>          
          <td><xsl:value-of select="title" /></td>            
          <td><xsl:value-of select="pages" /></td>
          <td><xsl:value-of select="price" /></td>
          <td>  
          <xsl:element name="img">
                <xsl:attribute name="style">
                    <xsl:text>width:200;height:200</xsl:text>
                </xsl:attribute>
                <xsl:attribute name="src">
                    <xsl:text>/storage/image/subjects/</xsl:text><xsl:value-of select="substring(image,22)"/>
                </xsl:attribute>       
          </xsl:element>
          </td>
        </tr>
      </tbody>
      </xsl:for-each>
    
      </table>
        <br/>
      </div>
    </div>
  </body>
</html>
</xsl:template>

</xsl:stylesheet>