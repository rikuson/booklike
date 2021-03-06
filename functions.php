<?php
/*
 * project   : OD Base
 * file name : functions.php
 * created   : 2017/06/13
 */
$translations = array(
	'ja' => array(
		'Update' => '更新',
		'Create' => '作成',
		'Latest Article' => '最新記事',
		'Updated At' => '更新日',
		'Created At' => '作成日',
		'Author' => '投稿者',
		'Category' => 'カテゴリ',
		'Read More' => '続きを読む'
	),
	'en' => array(
		'Update' => 'Update',
		'Create' => 'Create',
		'Latest Article' => 'Latest Article',
		'Updated At' => 'Updated At',
		'Created At' => 'Created At',
		'Author' => 'Author',
		'Category' => 'Category',
		'Read More' => 'Read More'
	)
);

if ( function_exists('qtranxf_getLanguage') ) {
	$translations = $translations[qtranxf_getLanguage()];
} else {
	$translations = $translations['ja'];
}

if ( ! function_exists( 'odbase_setup' ) ) :

function odbase_setup() {
	/*
	 * 自動フィードリンク
	 */
	add_theme_support( 'automatic-feed-links' );
	
	/*
	 * titleを自動で書き出し
	 */
	add_theme_support( 'title-tag' );
	
	/*
	 * アイキャッチ画像を設定できるようにする
	 */
	add_theme_support( 'post-thumbnails' );
	
	/*
	 * 検索フォーム、コメントフォーム、コメントリスト、ギャラリー、キャプションでHTML5マークアップの使用を許可します
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
	
	/*
	 * カスタム背景
	 */
	$args = array(
		'default-color' => 'ffffff',
		'default-image' => '',
	);
	add_theme_support( 'custom-background', $args );
	
	/*
	 * テーマカスタマイザーにおける編集ショートカット機能の使用
	 */
	add_theme_support( 'customize-selective-refresh-widgets' );
	
	/*
	 * カスタムメニュー位置を定義
	 */
	register_nav_menus( array(
		'global' => 'グローバルナビ',
	) );
	
}
endif;
add_action( 'after_setup_theme', 'odbase_setup' );

/*
 * 動画や写真を投稿する際のコンテンツの最大幅を設定
 */
function odbase_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'odbase_content_width', 640 );
}
add_action( 'after_setup_theme', 'odbase_content_width', 0 );

/*
 * サイドバーを定義
 */
function booklike_widgets_init() {
	register_sidebar( array(
		'name'          => 'Footer',
		'id'            => 'footer',
		'description'   => 'ここにウィジェットを追加',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'booklike_widgets_init' );

/*
 * スクリプトを読み込み
 */
function booklike_scripts() {
	wp_enqueue_style( 'booklike-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'booklike_scripts' );

/*
 * アーカイブタイトル
 */
function custom_archive_title( $title ){
    if ( is_category() ) {
        $title = single_term_title( '', false );
    }
    if ( is_tag() ) {
        $title = single_term_title( '#', false );
    }
    return $title;
}
add_filter( 'get_the_archive_title', 'custom_archive_title', 10 );

/*
 * excerpt（抜粋）設定
 */
function custom_excerpt_length( $length ) {
     return 100;
}	
add_filter( 'excerpt_length', 'custom_excerpt_length', 10 );
function new_excerpt_more( $more ) {
	global $translations;
	return '<a class="read-more" href="'. get_permalink( get_the_ID() ) . '">' . $translations['Read More'] . '</a>';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );

?>
