# GRAV, nodb İYS, Twig Tema Oluşturma ve Göç Süreci

#### Grav ismi Gravity kelimesinin sadece kısaltılmış bir versiyonudur.

#### Grav, modern, hızlı, basit, esnek, açık kaynak ve dosya tabanlı içerik yönetim sistemidir.

#### Teknolojiler
* Twig Templating: Symphony’ ninde kullandığı tema motoru.
* Markdown: Metinden HTML’ ye dönüştürme aracı.
* YAML: Konfigürasyon düzenlemeleri için.
* Parsedown: Markdown ve Markdown Extra özellikler için.
* Doctrine Cache: Performans için.
* Pimple Dependency Injection Container: Genişletilebilirlik ve bakım kolaylığı için.
* Symfony Event Dispatcher: Plugin etkileşimleri için.
* Symfony Console: CLI arayüzü için
* Gregwar Image Library: Görsel düzenleme kütüphanesi.

#### Avantajları
* Diğer içerik yönetim sistemleri gibi, içerik yönetimini yazılımcının mantığı ile yapmaz.
* Sadece mevcut en iyi yazılımları, uygun şekilde konuşturur.
* Sayfaların, karmaşık veri tabanı tablo ilişkileri yerine hiyerarşik bir ağaç yapısında olması, daha anlaşılır hale getirir.
* Eklentilerde, veritabanında ekstra anlaşılmaz tablolar açmaz, Controller yoksa sadece template klasöründe twig uzantılı dosya ekler.

#### Grav kasıtlı olarak az sayıda gereksinimle tasarlanmıştır.
* Web Sunucusu, Apache, Nginx, LiteSpeed, Lightly, IIS, vb.
* Betik Dili, PHP 7.1.3 veya üstü
* Veri Tabanı, Gerekli bir veritabanı yok, Grav, içeriğiniz için düz metin dosyaları ile oluşturulmuştur..

#### Kurulum
[Grav](https://getgrav.org/downloads) veya [Grav+Admin](https://getgrav.org/downloads) paketini indirin. 
ZIP dosyasını web sunucunuzun webroot’ una çıkarın, 
örn. ~/webroot/grav

#### Tavsiye
```
cd ~/webroot
git clone -b master https://github.com/getgrav/grav.git

cd ~/webroot/grav
composer install --no-dev -o

cd ~/webroot/grav
bin/grav install
```

#### Çoklu Site 

##### [setup.php](setup.php)

##### Klasörler Yapısı
```
/user/sites/site-adi/accounts 	Kullanıcı hesap dosyaları(.yaml)
/user/sites/site-adi/config 	Site için konfigürasyon dosyaları(.yaml)
/user/sites/site-adi/plugins 	/user/plugins klasörüne link
/user/sites/site-adi/pages 	Site için web sayfası dosyaları(.md), resim, video vb.

/user/plugins 			Eklentiler. 
/user/themes 			Temalar.
```

```
/user
└── /sites	
	└── /site-adi
		└── /pages
			├── /01.home
			├── /02.akademik
			│   ├── /akademik-birimler
			│   ├── /akademik-personel
			│   └── /akademik-takvim
			├── /03.etkinlikler
			│   ├── /etkinlik1
			│   └── /etkinlik2
			├── /04.hakkimizda
			└── /resim-galerisi
```

#### Web Sayfa Dosyası 
* Dosya adı, Markdown biçimli bir dosya olduğunu belirtmek için .md ile bitmelidir. Örn. default.md
* Dosyanın adı, kullanılacak temanın şablon dosyasının adını gösterir.
Örn. /user/themes/tema-adi/templates/default.html.twig 

Ana şablon dosyası için standart ad 'default' tur, dolayısıyla dosya /user/pages/site-adi/pages/01.home/default.md 
olarak adlandırılır. 

#### Örnek bir sayfa dosyası(default.md) şöyle görünebilir:
```
---
title: Page Title
publish_date: 01/23/2019 13:00
published: false
---
# Page Title

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque porttitor eu.
```
--- marker çifti, sayfa için temel YAML ayarlarından oluşur. 

Sonraki içerik, Markdown olarak yazılan, sitenizde derlenip HTML olarak işlenecek gerçek içeriktir.

HTML
```
<p>Geçerli <a href="https://tr.wikipedia.org/wiki/HTML">HTML</a> 
yazmak için, sözdizimi kurallarını doğru kullanmanız gerekir.
Bazı durumlarda ise belli kelimeleri kolayca <strong>bold</strong> 
yapmak ve belli kelimeleri de <em>italik</em> yapmak istersiniz 
sadece. Ya da bir liste oluşturmak:</p>

<ul>
<li>Kolay olmalı</li>
<li>Zor olmamalı</li>
</ul>
```
Markdown
```
Geçerli [HTML](https://tr.wikipedia.org/wiki/HTML) 
yazmak için, sözdizimi kurallarını doğru kullanmanız gerekir. 
Bazı durumlarda ise belli kelimeleri kolayca **bold** 
yapmak ve belli kelimeleri de *italik* yapmak istersiniz 
sadece. Ya da bir liste oluşturmak:

- Kolay olmalı
- Zor olmamalı
```

### Çoklu Dil Konfigürasyonu 

user/config/system.yaml
languages:
  supported:
    - tr
    - en

Her sayfa bir markdown dosyası ile temsil edilir, örneğin default.md 
Çok dilli desteği etkinleştirdiğinizde, Grav uygun şekilde adlandırılmış markdown dosyasını arayacaktır. 

Örneğin, Türkçe varsayılan dilimizdir, önce default.tr.md‘ yi arayacaktır. 
Bu dosya bulunamazsa, bir sonraki dili deneyecek ve default.en.md dosyasını arayacaktır, bu dosya bulunmazsa, Grav varsayılanına geri döner ve sayfa hakkında bilgi sağlamak için default.md dosyasını arar.

URL üzerinden Etkin Dil Türkçe olarak varsayılan dildir, tarayıcınızı bir dil belirtmeden işaret etseydiniz, içeriği default.tr.md dosyasında açıklandığı şekilde alırsınız, 
ancak tarayıcınızı şu adrese yönlendirerek de açıkça Türkçe' yi isteyebilirsiniz.

http://yoursite.com/tr

http://yoursite.com/hakkimizda
---
slug: about
---
http://yoursite.com/en/about

Collection

---
content:
    items: '@self.children'
    order:
        by: date
        dir: desc
    limit: 10
    pagination: true
---

{% for p in page.collection %}
<h2>{{ p.title }}</h2>
{{ p.summary }}
{% endfor %}

Children
  <h3 class="title">{{ t("BLOG.ITEM.IMAGE_GALLERIES") }}</h3>
  <div class="row page-row">
{% set _page = page.find('/galeri/resimler') %}	
{% for __page in _page.children.order('date', 'desc') %}
	<div class="row page-row">
	{% set _image = __page.media.images|first %}
	   <div class="col-md-12 col-sm-12 col-xs-12 text-center">
	     <div class="album-cover" style="min-height: inherit;">
	        <a title="{{ __page.title }}" href="{{ __page.url }}">
		  <img class="img-responsive img-thumbnail" src="{{ _image.url }}" alt="" />
	        </a>
	        <div class="desc" style="padding: 0px;">
	            <h4><small><a href="{{ __page.url }}">{{ __page.title }}</a></small></h4>
	        </div>
	     </div>
	   </div>
	</div>
{% endfor %}
  
Tema Yapımı

bin/gpm install devtools
bin/plugin devtools new-theme

blueprints.yaml	Grav tarafından temanız hakkında bilgi almak için 		kullanılan yapılandırma dosyası.

my-theme.yaml	Eklentinin kullanabileceği seçenekleri belirlemek 			için kullanılan eklentidir.

templates/ 	Sayfalarınızı oluşturmak için Twig şablonlarını 			içeren bir klasör.

templates/partials/ Twig şablonlarının için include edilebilen web 			sayfaları 

.
├── CHANGELOG.md
├── LICENSE
├── README.md
├── blueprints.yaml
├── fonts
├── my-theme.php
├── my-theme.yaml
├── screenshot.jpg
├── templates
│   ├── default.html.twig
│   ├── menu.html.twig
│   └── partials
│       ├── base.html.twig
│       └── header.html.twig
└── thumbnail.jpg

templates/default.html.twig
{% embed 'partials/base.html.twig' %}
{% block content %}
  <div class="content container">
    <div class="page-wrapper">
    {% include 'partials/breadcrumb.html.twig' %}
      <div class="page-content">
        <div class="row page-row">
          <div class="news-wrapper">  
  	    <p>{{ page.content }}</p>			 </div><!--//news-wrapper-->
       {% include 'partials/newsEvents.html.twig' %}
        </div><!--//page-row-->
      </div><!--//page-content-->
    </div><!--//page--> 
  </div><!--//content-->
{% endblock %}
{% endembed %}

templates/partials/base.html.twig

<!DOCTYPE html>
<head>
    {% set _page = page.find('/home') %}
    <title>{{ _page.header.birim_adi }}</title>
</head> 
<body class="home-page">
    <div class="wrapper">
        <!-- ******HEADER****** --> 
        {% include 'partials/header.html.twig' %}

        <!-- ******NAV****** -->
        {% include 'partials/mainMenu.html.twig' %}
		
        <!-- ******CONTENT****** --> 
        {% block content %}{% endblock %}		
    </div><!--//wrapper-->
    
    <!-- ******FOOTER****** --> 
    {% include 'partials/footer.html.twig' %}
</body>
</html> 

home.tr.md
---
title: Anasayfa
birim_adi: 'Eğitim Fakültesi'
mod: 1
theme: default
streetAddress: 'Ondokuz Mayıs Üniversitesi <br> Eğitim Fakültesi'
region: 'Kurupelit Kampüsü'
postalCode: '55200 Atakum, Samsun'
telephone: '+90 362 312 1919 - 5300'
fax: '+90 362 457 6078'
email: egitimfakultesi@omu.edu.tr
twitter: 'https://twitter.com/omurektorluk'
facebook: 'https://www.facebook.com/ondokuzmayis1975?ref=hl'
youtube: 'http://www.youtube.com/user/OMUVideo?feature=watch'
topMenu:
    -
        title: Anasayfa
        url: /
    -
        title: İletişim
        url: /iletisim
---

CLI Console

#cd ~/webroot/grav
#bin/grav		Temel Grav İşlemleri
#bin/gmp		Grav paket Yönetici işlemleri (Grav Package Manager)

Log viewer
#bin/grav logviewer

Eklenti güncelleme
#bin/gpm update

Grav güncelleme
bin/gpm selfupgrade

Göç İşlemleri

#composer require chrisullyott/csv-to-grav

cp -R /usr/local/www/grav/user/sites/sablon.omu.edu.tr/pages/* ${dizin}pages/

<?
fwrite($myfile, "title_field,date_field,html_field,author_field,dizin,icerikdizin,sablon\n");
foreach( $json->d as $haber) {
        $txt = trim(str_replace(",", " ", $haber->annoTitle)) .',"'. trim(str_replace(",", " ", $haber->annoDate)) .'",'. $string = trim(str_replace(",", " ", preg_replace('/\s+/', ' ', $haber->AnnoContent)))
                .",root," .$fakulte. "2.omu.edu.tr/,haberler/" .sprintf('%02d.', ++$i).$haber->annoSeolink. ",announcement.tr\n" ;
        fwrite($myfile, $txt);
}

Göç İşlemleri

covert.php

<?
$conversion->setColumnMap(array(
    'title'    => 'title_field',   
    'date'     => 'date_field',     
    'html'     => 'html_field',    
    'author'   => 'author_field',  
    'dizin‘    => 'dizin',       
    'icerikdizin'=> 'icerikdizin',       
    'sablon‘   => 'sablon'      
));

$count = $conversion->build();







