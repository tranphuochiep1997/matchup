<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output method="html" doctype-system="about:legacy-compat"/>
    <xsl:template match="/">
        <!--  match root element  -->
        <html>
            <head>
                <meta charset="utf-8"/>
                <link rel="stylesheet" type="text/css" href="index.css"/>
                <link rel="stylesheet" type="text/css" href="../stylesheets/style.css"/>
                <title>Matches</title>
            </head>
            <body>
            
                <div class="container">
                <table>
                    <caption>Information about matches</caption>
                    <thead>
                        <tr>
                            <th>TiTle</th>
                            <th>Time</th>
                            <th>Kind</th>
                            <th>Location</th>
                            <th>Score A</th>
                            <th>Score B</th>
                            <th>Team</th>
                        </tr>
                    </thead>
                    <!--  insert each name and paragraph element value  -->
                    <!--  into a table row.  -->
                    <xsl:for-each select="/matches/match">
                        <tr>
                            <td>
                                <xsl:value-of select="title"/>
                            </td>
                            <td>
                                <xsl:value-of select="startTime"/>
                            </td>
                            <td>
                                <xsl:value-of select="kind"/>
                            </td>
                            <td>
                                <xsl:value-of select="location"/>
                            </td>
                            <td>
                                <xsl:value-of select="scoreA"/>
                            </td>
                            <td>
                                <xsl:value-of select="scoreB"/>
                            </td>
                            <td>
                                <xsl:value-of select="team"/>
                            </td>
                        </tr>
                    </xsl:for-each>
                </table>
                </div>
                <!-- <?php include('../common/header.php'); ?> -->
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>