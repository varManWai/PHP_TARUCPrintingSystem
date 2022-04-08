<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="/">
<html>
<body>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />
    <title>Subjects in XML</title>

    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
    <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection" />
  </head>
  <nav class="red darken-4" role="navigation">
      <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo">Subjects in XML</a></div>
  </nav>
  <div class="container">
    <h1 class="header center black-text" style="font-family: Candara">Lists of subjects available</h1>
    <div class="row center">
    <table class="centered">
      <thead>
        <tr>        
          <th>ID</th>
          <th>Course Code</th>
          <th>Title</th>
          <th>Pages</th>
          <th>Price (RM)</th>
          <th>Image</th>
        </tr>
      </thead>
            
      <xsl:for-each select="/subjects/subject">
            <script>
                let path = <xsl:value-of select="productImage"/>;
                document.getElementById("path").innerHTML = path.substring(22);
            </script> 
            @php
              vardump(productImage);
            @endPhp
      <tbody>
        <tr>
          <td><xsl:value-of select="subjectID" /></td>
          <td><xsl:value-of select="courseCode" /></td>          
          <td><xsl:value-of select="title" /></td>            
          <td><xsl:value-of select="pages" /></td>
          <td><xsl:value-of select="price" /></td>
          <td>                            
            <img style="width:150;height:104;">
              <xsl:attribute name="src">/storage/images/subjects/<span id="path"></span></xsl:attribute>
              
            </img>
            
          </td>
        </tr>
      </tbody>
      </xsl:for-each>
    
      </table>
        <br/>
        <a class="waves-effect waves-light orange btn" href="adminMain">Back To Admin Panel</a>
      </div>
    </div>
  </body>
</html>
</xsl:template>

</xsl:stylesheet>