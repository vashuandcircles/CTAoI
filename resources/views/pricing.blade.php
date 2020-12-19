@include('partials.header')
<style>
article {
  width:100%;
  max-width:1000px;
  margin:0 auto;
  height:1000px;
  position:relative;
}
ul {
  display:flex;
  top:0px;
  z-index:10;
  padding-bottom:14px;
}
li {
  list-style:none;
  flex:1;
}
li:last-child {
  border-right:1px solid #DDD;
}
button {
  width:100%;
  border: 1px solid #DDD;
  border-right:0;
  border-top:0;
  padding: 10px;
  background:#FFF;
  font-size:14px;
  font-weight:bold;
  height:60px;
  color:#999
}
li.active button {
  background:#F5F5F5;
  color:#000;
}
table { border-collapse:collapse; table-layout:fixed; width:100%; }
th { background:#F5F5F5; display:none; }
td, th {
  height:53px
}
td,th { border:1px solid #DDD; padding:10px; empty-cells:show; }
td,th {
  text-align:left;
}
td+td, th+th {
  text-align:center;
  display:none;
}
td.default {
  display:table-cell;
}
.bg-purple {
  border-top:3px solid #A32362;
}
.bg-blue {
  border-top:3px solid #0097CF;
}
.sep {
  background:#F5F5F5;
  font-weight:bold;
}
.txt-l { font-size:28px; font-weight:bold; }
.txt-top { position:relative; top:-9px; left:-2px; }
.tick { font-size:18px; color:#2CA01C; }
.hide {
  border:0;
  background:none;
}

@media (min-width: 640px) {
  ul {
    display:none;
  }
  td,th {
    display:table-cell !important;
  }
  td,th {
    width: 330px;
  
  }
  td+td, th+th {
    width: auto;
  }
}
</style>
<script>
// DIRTY Responsive pricing table JS

$( "ul" ).on( "click", "li", function() {
  var pos = $(this).index()+2;
  $("tr").find('td:not(:eq(0))').hide();
  $('td:nth-child('+pos+')').css('display','table-cell');
  $("tr").find('th:not(:eq(0))').hide();
  $('li').removeClass('active');
  $(this).addClass('active');
});

// Initialize the media query
  var mediaQuery = window.matchMedia('(min-width: 640px)');
  
  // Add a listen event
  mediaQuery.addListener(doSomething);
  
  // Function to do something with the media query
  function doSomething(mediaQuery) {    
    if (mediaQuery.matches) {
      $('.sep').attr('colspan',5);
    } else {
      $('.sep').attr('colspan',2);
    }
  }
  
  // On load
  doSomething(mediaQuery);
</script>
<article>

<ul>
  <li class="bg-purple">
    <button>Self-Employed</button>
  </li>
  <li class="bg-blue">
    <button>Simple Start</button>
  </li>
  <li class="bg-blue active">
    <button>Essentials</button>
  </li>
  <li class="bg-blue">
    <button>Plus</button>
  </li>
</ul>  

<table>
  <thead>
    <tr>
      <th class="hide"></th>
      <th class="bg-purple">Self-Employed</th>
      <th class="bg-blue">Simple Start</th>
      <th class="bg-blue default">Essentials</th>
      <th class="bg-blue">Plus</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Monthly price</td>
      <td><span class="txt-top">&pound;</span><span class="txt-l">6</span></td>
      <td><span class="txt-top">&pound;</span><span class="txt-l">7</span></td>
      <td class="default"><span class="txt-top">&pound;</span><span class="txt-l">15</span></td>
      <td><span class="txt-top">&pound;</span><span class="txt-l">25</span></td>
    </tr>
    <tr>
      <td colspan="5" class="sep">Get started easily</td>
    </tr>
    <tr>
      <td>Includes free updates and new features as they become available</td>
      <td><span class="tick">&#10004;</span></td>
      <td><span class="tick">&#10004;</span></td>
      <td class="default"><span class="tick">&#10004;</span></td>
      <td><span class="tick">&#10004;</span></td>
    </tr>
    <tr>
      <td>No software to install — sign up online in moments</td>
      <td><span class="tick">&#10004;</span></td>
      <td><span class="tick">&#10004;</span></td>
      <td class="default"><span class="tick">&#10004;</span></td>
      <td><span class="tick">&#10004;</span></td>
    </tr>
    <tr>
      <td>Import customer & supplier details from Excel, Outlook and .csv</td>
      <td></td>
      <td><span class="tick">&#10004;</span></td>
      <td class="default"><span class="tick">&#10004;</span></td>
      <td><span class="tick">&#10004;</span></td>
    </tr>
    <tr>
      <td>Accept card payments in QuickBooks Online</td>
      <td></td>
      <td><span class="tick">&#10004;</span></td>
      <td class="default"><span class="tick">&#10004;</span></td>
      <td><span class="tick">&#10004;</span></td>
    </tr>
    <tr>
      <td colspan="5" class="sep">Stay protected and get support</td>
    </tr>
    <tr>
      <td>Free telephone and online support</td>
      <td></td>
      <td><span class="tick">&#10004;</span></td>
      <td class="default"><span class="tick">&#10004;</span></td>
      <td><span class="tick">&#10004;</span></td>
    </tr>
    <tr>
      <td>Strong encryption protects your business data</td>
      <td><span class="tick">&#10004;</span></td>
      <td><span class="tick">&#10004;</span></td>
      <td class="default"><span class="tick">&#10004;</span></td>
      <td><span class="tick">&#10004;</span></td>
    </tr>
    <tr>
      <td>Automatic data backups</td>
      <td><span class="tick">&#10004;</span></td>
      <td><span class="tick">&#10004;</span></td>
      <td class="default"><span class="tick">&#10004;</span></td>
      <td><span class="tick">&#10004;</span></td>
    </tr>
  </tbody>
</table>
  
</article>
@include('partials.footer')