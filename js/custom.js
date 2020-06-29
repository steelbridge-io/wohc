//$("a[target='_blank']").append('<span class="screen-reader-text"> (opens in new tab) <\span>');
document.getElementById('genesis-nav-footer').setAttribute('aria-label', 'footer navigation');
window.onload = function() {
  var list, index;
  list = document.getElementsByClassName("site-header");
  for (index = 0; index < list.length; ++index) {
    list[index].setAttribute('aria-label', 'Page title is below');
  }
  var list2, index2;
  list2 = document.getElementsByClassName( "entry-header" );
  for (index2 = 0; index2 < list2.length; ++index2) {
    list2[index2].setAttribute( 'aria-label', 'Page title');
  }
}

var arr = ['West Oakland Health Care'];
$('body img').each(function() {
  if ( ! $(this).attr('alt'))
    $(this).attr('alt', arr[Math.round(Math.random() * (arr.length - 1))]);
});
