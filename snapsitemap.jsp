<%
   //----------------------------------------------------------------------------------
   // @@@ SnapSitemap.com Remote Sitemap Script (JSP) (v20120322) @@@
   // This script allow SnapSitemaps customers to serve an always up to date version 
   // of their sitemap from there own web server without needing to perform updates.
   // Please contact support@snapsitemap with any questions.
   //----------------------------------------------------------------------------------

   try {
      String url = "http://www.snapsitemap.com/rpc/remote-sitemap?" + request.getQueryString();
      HttpURLConnection conn = (HttpURLConnection)new URL(url).openConnection();
      conn.setRequestProperty("X-Script-Id","8dbb4b11-8aa7-4c6e-828d-4031952fbcdd");
      conn.setRequestProperty("X-Script-Version","20120322-jsp");
      conn.setRequestProperty("X-Forwarded-For",request.getRemoteAddr());
      conn.setRequestProperty("X-Forwarded-For-Host",request.getHeader("Host"));
      conn.setRequestProperty("X-Forwarded-For-Agent",request.getHeader("User-Agent"));
      if(conn.getResponseCode() != 200) throw new Exception("Response Code " + conn.getResponseCode());
      response.setContentType(conn.getHeaderField("Content-Type"));
      char[] buff = new char[32768];
      InputStreamReader in = new InputStreamReader(conn.getInputStream());
      for(int r; (r = in.read(buff)) != -1;) out.write(buff,0,r);
   } catch(Exception e) {
      response.setStatus(503);
      out.println("<html><h1>Temporarily Unavailable</h1><p>" + e + "</p></html>");
   }
%>
<%@page session="false"%>
<%@page import="java.net.*"%>
<%@page import="java.io.*"%>

