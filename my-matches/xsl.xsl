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
                <div class="header-nav">
                    <ul id="menu">
                        <li style="float:left">
                            <a class="home" href="/matchup/home">MATCH MAKING</a>
                        </li>
                        <li>
                            <a href = "/matchup/auth/logout.php">Logout</a>
                        </li>
                        <li>
                            <a href="/matchup/form-create-match">Create Match</a>
                        </li>
                        <li>
                            <a href="/matchup/my-matches/">My Matches</a>
                        </li>
                        <li>
                            <a href="/matchup/ranking">Ranking</a>
                        </li>
                    </ul>
                </div>
                <div class="container">
                    <table class = "matches">
                        <caption>Information about your matches</caption>
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Time</th>
                                <th>Kind</th>
                                <th>Location</th>
                                <th>Score A</th>
                                <th>Score B</th>
                                <th>Team</th>
                                <th>Action</th>
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
                                <td>
                                    <a href="/matchup/match_detail/index.php?id={@id}">Detail</a>
                                </td>

                            </tr>
                        </xsl:for-each>
                    </table>
                </div>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>