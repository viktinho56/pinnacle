<footer style="background-color: #1C2E45;">
  <div class="content">
    <div class="row">
      <div class="col-lg-4 col-md-6 col-sm-12">
        <label class="h5 text-white">
          ABOUT US     </label>
        <br/>
        <label class="h6 text-white" style="text-align:left;line-height: 25px;">
          PML offers a cost-effective and 
          guaranteed alternative to the purchase
           and delivery of products for all. 
           Whether you are sending <br/> 
           a gift to a loved one or a parcel to a customer,<br/>
            we offer a quick and reliable sending service which fits around your busy lifestyle.
        </label>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-12">
        <label class="h5 text-white">
          Other Links   </label>
        <br/>
        <ul>
        <li><a href="index">About Us </a></li>
        <li><a href="index">Contact </a></li>
        <li><a href="index">FAQs</a></li>
         <li><a href="help_support">Help & Support</a></li>
          <li><a href="#">Cookies Policy</a></li>
          <li><a href="#">Terms & Conditions</a></li>
          <li><a href="privacy_policy">Privacy Policy</a></li>
          
        </ul>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-12">
      <label class="h5 text-white">
          CONTACT US     </label>
        <br/>
        <label class="h6 text-white"> <i class='bx bx-envelope'></i> info@pinnaclemachinery.co.uk</label><br/>
        <label class="h6 text-white"> <i class='bx bx-phone'></i> +44 (0) 7585 958182</label><br/>
        <label class="h6 text-white"><i class='bx bx-phone'></i> +44 (0) 7983 832188</label>
        <br/>
        <label class="h6 text-white"><i class='bx bx-phone'></i> +254 (0) 703 518137</label>
        <br/> <a href="#"><img height="50px" src='public/images/facebook.svg'/></a> <a href="#"><img height="50px" src='public/images/twitter.svg'/></a><br/>
    </div>
    </div>
  </div>
</footer>




<script src="../../public/vendors/base/vendor.bundle.base.js"></script>
<script src="../../public/js/off-canvas.js"></script>
<script src="../../public/js/hoverable-collapse.js"></script>
<script src="../../public/js/template.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@3.6.12/dist/js/splide.min.js"></script>

<script>
  $(window).bind('scroll', function() {
    var currentTop = $(window).scrollTop();
    var elems = $('.scrollspy');
    elems.each(function(index){
      var elemTop 	= $(this).offset().top;
      var elemBottom 	= elemTop + $(this).height();
      if(currentTop >= elemTop && currentTop <= elemBottom){
        var id 		= $(this).attr('id');
        var navElem = $('a[href="#' + id+ '"]');
    navElem.parent().addClass('active').siblings().removeClass( 'active' );
      }
    })
}); 

</script>
</body>
</html>
