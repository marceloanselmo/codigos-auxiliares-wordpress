<h1 align="center">Repositório de códigos</h1>
<p align="center">Para<strong> facilitar </strong> a nossa vida!</p>

##1 alt-gen: gera alt text automaticamente;


##2 alt-text-gravatar: gera alt em imagens de gravatar;


##3 autofill-alt: gera alt ao fazer aupload de imagens;


##4 breadcrumbs: breadcrumbs(em caso de não usar shortcode de Yoast nem de RankMath);


##5 author-info: cria um box com informações do autor do post. Deve ser usado na página single.php;


##6 classic-editor: bloqueia o Editor Gutemberg e libera o Editor Clássico;


##7 gen-meta-description: gera meta description para post baseado no conteúdo(the_content);


##8 minify-html: deixa o código HTML de uma página compacto;

##9 post-duplicator: clona/duplica post gerando um rascunho(testar se funciona para Web Stories);

##10 upload-svg: função que permite realizar  upload de imagens no formato svg;


<h4>Para deixar o código organizado, basta criar uma pasta com nome inc ou custom-functions. E depois é só colocar o caminho das funções em function.php:</h4>


require get_template_directory() . '/inc/auto-attribute-img.php'; <br>
require get_template_directory() . '/inc/classic-editor.php'; <br>
require get_template_directory() . '/inc/hide-my-wp.php'; <br>
require get_template_directory() . '/inc/upload-svg.php'; <br>
require get_template_directory() . '/inc/minify-html.php'; <br>
require get_template_directory() . '/inc/breadcrumbs.php'; <br>
require get_template_directory() . '/inc/post-duplicator.php'; <br>
require get_template_directory() . '/inc/autofill-alt.php'