<?php /* @var $this Controller */ ?>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/nl_NL/sdk.js#xfbml=1&version=v2.4&appId=128993440624014";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<?php $this->beginContent('//layouts/main'); ?>
<div class="span-17">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<div class="span-9 last">
	<div id="sidebar">
<div class="fb-page" data-href="https://www.facebook.com/hikeapp.nl" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/hikeapp.nl"><a href="https://www.facebook.com/hikeapp.nl">Hike-app</a></blockquote></div></div>
	</div><!-- sidebar -->
</div>
<?php $this->endContent(); ?>