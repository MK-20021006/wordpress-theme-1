<?php
	stk_hook_footer_before();
?>
<footer id="footer" class="footer">
	<div id="inner-footer" class="inner wrap cf">
		<?php stk_footerwidget(); ?>

		<div id="footer-bottom">
			<?php
				stk_footerlinks();
				stk_snslinks('footer');
				stk_footercopyright();
			?>
		</div>
	</div>
</footer>
</div>
<?php wp_footer(); ?>
</body>
</html>