<?php
/**
 * The front page template file
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Bojler_Site
 * @since 1.0
 * @version 1.0
 */

$post_id = get_the_ID();

get_header();
?>

<section class="u-bg-blue u-text-white u-pt-16 u-pb-16">
	<div class="o-container">
		<div class="o-row">
			<div class="o-col-10@lg o-col-8@xl o-offset-1@lg">
				<?php if ( ! empty( $main_title ) ) : ?>
				<h2 class="u-text-xxl u-font-normal u-font-bold"><?php echo esc_html( $main_title ); ?></h2>
				<?php endif; ?>
				<?php if ( ! empty( $main_text ) ) : ?>
				<div class="u-h5 u-mb-3">
					<?php echo $main_text; // WPCS: xss ok. ?>
				</div>
				<?php endif; ?>
				<?php if ( ! empty( $get_started_link ) && ! empty( $get_started_text ) ) : ?>
				<a href="<?php echo esc_url( $get_started_link ); ?>" class="c-btn c-btn--white-blue c-btn--lg u-h6 u-mr-1 u-mb-2"><?php echo esc_html( $get_started_text ); ?></a>
				<?php endif; ?>
				<?php if ( ! empty( $bojler_repo_url ) ) : ?>
					<a target="_blank" href="<?php echo esc_url( $bojler_repo_url ); ?>" class="c-btn c-btn--bordered-white c-btn--lg u-h6 u-mb-2"><?php echo esc_html( 'View on GitHub' ); ?></a>
				<?php endif; ?>
				<?php if ( ! empty( $bojler_repo_version ) && ! empty( $bojler_repo_dl_url ) ) : ?>
					<p class="u-text-sm"><a href="<?php echo esc_url( $bojler_repo_dl_url ); ?>" target="_blank"><em><?php echo esc_html( 'Download —' ) . ' ' . esc_html( $bojler_repo_version ); ?></em></a></p>
				<?php endif; ?>
			</div><!-- /.o-col -->
		</div><!-- /.o-row -->
	</div><!-- /.o-container -->
</section>
<?php
if (
	have_rows( 'why_bojler_items' ) ||
	have_rows( 'features' )
) :
?>
<section class="u-bg-gray-30 u-pt-8 u-pb-4">
	<div class="o-container">
	<?php if ( have_rows( 'why_bojler_items' ) ) : ?>
		<?php
		$why_bojler_title   = get_field( 'why_bojler_title' );
		$why_bojler_content = get_field( 'why_bojler_text' );
		?>
		<div class="o-row">
			<div class="o-col-10@lg o-col-8@xl o-offset-1@lg u-mb-4 u-mr-auto">
				<?php if ( ! empty( $why_bojler_title ) ) : ?>
				<h2 class="u-h1 u-font-normal"><?php echo esc_html( $why_bojler_title ); ?></h2>
				<?php endif; ?>
				<?php if ( ! empty( $why_bojler_content ) ) : ?>
				<div class="u-text-md">
					<?php echo $why_bojler_content; // WPCS: xss ok. ?>
				</div>
				<?php endif; ?>
			</div><!-- /.o-col -->
		</div><!-- /.o-row -->
		<div class="o-row u-mb-5">
			<?php while ( have_rows( 'why_bojler_items' ) ) : ?>
				<?php
				the_row();

				$why_bojler_item_icon    = get_sub_field( 'icon' );
				$why_bojler_item_title   = get_sub_field( 'title' );
				$why_bojler_item_content = get_sub_field( 'content' );

				if (
					! empty( $why_bojler_item_icon ) ||
					! empty( $why_bojler_item_title ) ||
					! empty( $why_bojler_item_content )
				) :
				?>
				<div class="o-col-6@md o-col-4@lg u-mb-3">
					<div class="c-feature-card">
					<?php if ( ! empty( $why_bojler_item_icon ) ) : ?>
						<?php
						$svg_icon_path = bojler_acf_icon_picker_svg_icon( $why_bojler_item_icon );

						if ( ! empty( $svg_icon_path ) ) :
							?>
							<div class="c-feature-card__icon">
								<?php echo file_get_contents( $svg_icon_path ); // WPCS: xss ok. ?>
							</div><!-- /.c-feature-card__icon -->
						<?php endif; ?>
					<?php endif; ?>
						<?php
						if (
							! empty( $why_bojler_item_title ) ||
							! empty( $why_bojler_item_content )
						) :
						?>
						<div class="c-feature-card__content">
							<?php if ( ! empty( $why_bojler_item_title ) ) : ?>
								<h4 class="c-feature-card__title"><?php echo esc_html( $why_bojler_item_title ); ?></h4>
							<?php endif; ?>
							<?php if ( ! empty( $why_bojler_item_content ) ) : ?>
								<?php echo $why_bojler_item_content; // WPCS: xss ok. ?>
							<?php endif; ?>
						</div><!-- /.c-featured-card__content -->
						<?php endif; ?>
					</div><!-- /.c-feature-card -->
				</div><!-- /.o-col -->
				<?php endif; ?>
			<?php endwhile; ?>
		</div><!-- /.o-row -->
	<?php endif; ?>
	<?php if ( have_rows( 'features' ) ) : ?>
		<?php
		$features_title   = get_field( 'features_title' );
		$features_content = get_field( 'features_content' );

		if (
			! empty( $features_title ) ||
			! empty( $features_content )
		) :
		?>
		<div class="o-row">
			<div class="o-col-10@lg o-col-8@xl o-offset-1@lg u-mb-4 u-mr-auto">
				<?php if ( ! empty( $features_title ) ) : ?>
				<h2 class="u-h1 u-font-normal"><?php echo esc_html( $features_title ); ?></h2>
				<?php endif; ?>
				<?php if ( ! empty( $features_content ) ) : ?>
				<div class="u-text-md">
					<?php echo $features_content; // WPCS: xss ok. ?>
				</div>
				<?php endif; ?>
			</div><!-- /.o-col -->
		</div><!-- /.o-row -->
		<?php endif; ?>
		<div class="o-row u-mb-5">
			<?php while ( have_rows( 'features' ) ) : ?>
			<?php
			the_row();

			$features_icon        = get_sub_field( 'icon' );
			$features_sub_title   = get_sub_field( 'title' );
			$features_sub_content = get_sub_field( 'text' );

			if (
				! empty( $features_icon ) ||
				! empty( $features_sub_title ) ||
				! empty( $features_sub_content )
			) :
			?>
			<div class="o-col-6@md o-col-4@lg u-mb-3">
				<div class="c-feature-card">
				<?php if ( ! empty( $features_icon ) ) : ?>
					<?php
					$features_icon_path = bojler_acf_icon_picker_svg_icon( $features_icon );

					if ( ! empty( $features_icon_path ) ) :
						?>
						<div class="c-feature-card__icon">
							<?php echo file_get_contents( $features_icon_path ); // WPCS: xss ok. ?>
						</div><!-- /.c-feature-card__icon -->
					<?php endif; ?>
				<?php endif; ?>
					<?php
					if (
						! empty( $features_sub_title ) ||
						! empty( $features_sub_content )
					) :
					?>
					<div class="c-feature-card__content">
						<?php if ( ! empty( $features_sub_title ) ) : ?>
							<h4 class="c-feature-card__title"><?php echo esc_html( $features_sub_title ); ?></h4>
						<?php endif; ?>
						<?php if ( ! empty( $features_sub_content ) ) : ?>
							<?php echo $features_sub_content; // WPCS: xss ok. ?>
						<?php endif; ?>
					</div><!-- /.c-featured-card__content -->
					<?php endif; ?>
				</div><!-- /.c-feature-card -->
			</div><!-- /.o-col -->
			<?php endif; ?>
		<?php endwhile; ?>
		</div><!-- /.o-row -->
		<?php
		$cta_block_title          = get_field( 'cta_block_title' );
		$cta_block_content        = get_field( 'cta_block_content' );
		$cta_block_left_btn_link  = get_field( 'cta_block_left_button_link' );
		$cta_block_left_btn_text  = get_field( 'cta_block_left_button_text' );
		$cta_block_right_btn_text = get_field( 'cta_block_right_button_text' );

		if (
			! empty( $cta_block_title ) ||
			! empty( $cta_block_content ) ||
			( ! empty( $cta_block_left_btn_link ) && ! empty( $cta_block_left_btn_text ) ) ||
			( ! empty( $bojler_repo_dl_url ) && ! empty( $cta_block_right_btn_text ) )
		) :
		?>
		<div class="o-row">
			<div class="o-col-10@lg o-col-8@xl o-offset-1@lg u-mb-4 u-mr-auto">
				<?php if ( ! empty( $cta_block_title ) ) : ?>
					<h2 class="u-h1 u-font-normal"><?php echo esc_html( $cta_block_title ); ?></h2>
				<?php endif; ?>
				<?php if ( ! empty( $cta_block_content ) ) : ?>
				<div class="u-text-md u-mb-3">
					<?php echo $cta_block_content; // WPCS: xss ok. ?>
				</div>
				<?php endif; ?>
				<?php
				if (
					! empty( $cta_block_left_btn_link ) &&
					! empty( $cta_block_left_btn_text )
				) :
				?>
					<a href="<?php echo esc_url( $cta_block_left_btn_link ); ?>" class="c-btn c-btn--gray c-btn--lg u-text-md u-mr-1 u-mb-2"><?php echo esc_html( $cta_block_left_btn_text ); ?></a>
				<?php endif; ?>
				<?php
				if (
					! empty( $bojler_repo_dl_url ) &&
					! empty( $cta_block_right_btn_text )
				) :
				?>
					<a href="<?php echo esc_url( $bojler_repo_dl_url ); ?>" class="c-btn c-btn--bordered-gray c-btn--lg u-text-md u-mb-2"><?php echo esc_html( $cta_block_right_btn_text ); ?></a>
				<?php endif; ?>
			</div><!-- /.o-col -->
		</div><!-- /.o-row -->
		<?php endif; ?>
	<?php endif; ?>
	</div><!-- /.o-container -->
</section>
<?php endif; ?>
<?php get_footer(); ?>
