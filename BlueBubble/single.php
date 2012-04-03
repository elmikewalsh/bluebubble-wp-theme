<?php $bb_portfolio_cat = get_option('bb_portfolio_cat');
if ( in_category($bb_portfolio_cat) ) {
  include(TEMPLATEPATH . '/single_portfolio.php');
} else {
  include(TEMPLATEPATH . '/single_blog.php');
}
?>