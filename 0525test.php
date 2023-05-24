<!DOCTYPE html>
<html>
<head>
  <title>按键显示不同页面</title>
  <style>
    .page {
      display: none;
    }
    #page1{
        display: block;
    }
  </style>
</head>
<body>
  <button onclick="showPage('page1')">页面1</button>
  <button onclick="showPage('page2')">页面2</button>
  <div id="page1" class="page">
    <h1>页面1</h1>
    <!-- 页面1的内容 -->
  </div>
  <div id="page2" class="page">
    <h1>页面2</h1>
    <!-- 页面2的内容 -->
  </div>
  
  <script>
    function showPage(pageId) {
      var pages = document.getElementsByClassName('page');
      for (var i = 0; i < pages.length; i++) {
        pages[i].style.display = 'none';
      }
      document.getElementById(pageId).style.display = 'block';
    }
  </script>
</body>
</html>