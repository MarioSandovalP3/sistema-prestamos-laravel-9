{{--
 * ARCHIVO: styles.blade.php
 * PROPÓSITO: Consolidación de estilos globales y componentes de la aplicación
 * ESTRUCTURA:
 *   1. Dependencias CSS externas
 *   2. Estilos base y globales
 *   3. Componentes UI principales
 *   4. Estilos específicos de módulos
 *   5. Media queries responsive
--}}

{{-- 1. DEPENDENCIAS EXTERNAS --}}
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/loader.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('plugins/notification/snackbar/snackbar.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('plugins/sweetalerts/sweetalert2.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/css/dashboard/dash_1.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('css/login.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">


{{-- 2. ESTILOS BASE Y GLOBALES --}}
{{--
 * Estructura base HTML/Body
 * Estilos para estado de autenticación
 * Animaciones y utilidades globales
--}}

@auth
@else
 <style type="text/css">

.sidebar-wrapper {
	border-radius: 0px 0px 0 0;
	top: 0px;
}

#content {
	margin-top: 0px!important;
}

</style> @endauth

{{-- 3. COMPONENTES UI PRINCIPALES --}}
{{--
 * Loaders y animaciones
 * Controles de formulario
 * Previsualización de imágenes
 * Componentes específicos (sidebar, header)
--}}
<style type="text/css"> html,
body {
	font-family: Arial, sans-serif;
	font-weight: 400;
	overflow-x: hidden;
	overflow-y: auto;
	height: 100%;
}

.loader-upload {
	width: auto;
	border-radius: 10px;
	background: #fff;
	display: flex;
	flex-direction: column;
	align-items: center;
	justify-content: space-evenly;
	box-shadow: 2px 2px 10px -5px lightgrey;
}

.loader-upload label {
	color: #002;
	font-size: 18px;
	animation: bit 0.6s alternate infinite;
}

.ck-balloon-panel {
	z-index: 1050 !important;
}

.layout-px-spacing {
	overflow: auto!important
}

@keyframes bit {
	from {
		opacity: 0.3;
	}
	to {
		opacity: 1;
	}
}

@keyframes loading {
	0% {
		left: -25%;
	}
	100% {
		left: 70%;
	}
	0% {
		left: -25%;
	}
}

.image-responsive {
	object-fit: contain;
}

#to_upload a {
	display: inline-block;
	position: relative;
	overflow: hidden;
	vertical-align: top;
	text-decoration: none;
}

#to_upload a input {
	position: absolute;
	top: 0;
	left: 0;
	opacity: 0;
	z-index: 10;
	width: 100%;
}

#to_upload>div {
	margin-top: 5px;
	overflow: hidden;
}


/* 5 imagenes por fila */

#to_upload>div>div {
	width: 150px;
	height: 125px;
	padding-right: 1%;
	padding-left: 1%;
	float: left;
	background-size: cover;
}

.sub-header-container .navbar {
	box-shadow: none !important;
	background: #f4f4f4 !important;
}

.header-modal {
	background: #3469b7;
}


/** Login **/

.header {
	background: #3469b7!important;
}

.navbar .theme-brand li.theme-text a {
	color: #FFFFFF!important;
}

#sidebar ul.menu-categories li.menu>.dropdown-toggle[aria-expanded="true"]:not([data-active="true"]) {
	background: #3b3f5c!important;
}

.navbar .navbar-item .nav-item form.form-inline input.search-form-control {
	background-color: #ffffff!important;
	color: #424242;
	border: solid;
}

.sub-header-container .navbar .sidebarCollapse svg {
	width: 40px;
	height: 40px;
	color: #3469b7!important;
}


/*** End ***/

.header-container .navbar {
	padding: 10px 0!important;
}

.dd-thumbnail {
	min-height: 100px;
	/* Establece la altura mínima del contenedor */
	background-size: contain;
	/* Ajusta el tamaño de la imagen para cubrir completamente el contenedor */
	background-position: center;
	/* Centra la imagen dentro del contenedor */
	object-fit: contain;
}

.dd-thumbnail i {
	/*icon size*/
	font-size: 50px;
	margin-top: 40px;
	color: #000;
}

.dd-file-info {
	width: 100%
}

.dd-file-info span {
	float: left;
	font-size: 12px;
	padding-top: 3px;
}

.dd-file-info button {
	float: right;
	background: none;
	border: none;
	outline: none;
	color: #444444;
}

.layout-boxed html,
.layout-boxed body {
	height: 100%;
}

.floating-button {
	position: fixed;
	bottom: 20px;
	right: 50px;
	z-index: 100;
	/* Ensure button is above other content */
}

.ck-content {
	color: #000000;
}

.ck-content h1,
h2,
h3,
h4,
h5,
h6 {
	color: #000000
}


{{-- 3.1 COMPONENTE: INPUT DE ARCHIVOS --}}
{{--
 * Estructura visual para uploads
 * Estados hover y activos
 * Previsualización de imágenes
 * Customización de controles
--}}

.filelabel {
	width: 250px;
	border: 2px dashed grey;
	border-radius: 5px;
	display: block;
	padding: 2px;
	transition: border 300ms ease;
	cursor: pointer;
	text-align: center;
	margin: 0;
}

.filelabel i {
	display: block;
	font-size: 20px;
}

.filelabel i,
.filelabel .title {
	color: grey;
	transition: 200ms color;
	font-size: 12px;
}

.filelabel:hover {
	border: 2px solid #1665c4;
}

.filelabel:hover i,
.filelabel:hover .title {
	color: #1665c4;
}

#FileInput {
	display: none;
}

#FileInput-1 {
	display: none;
}

#FileInput-2 {
	display: none;
}

#FileInput-3 {
	display: none;
}

.preview {
	max-width: 100%;
	max-height: 100%;
	border-radius: 5px;
}

.dd-thumbnail {
	width: 100px;
	object-fit: contain;
	background-repeat: no-repeat;
}

.preview-img img {
	width: 80px;
	height: 60px;
	object-fit: contain;
	background-repeat: no-repeat;
}


/*** partners ***/

.position-partners {
	position: absolute;
	right: 5px;
}

.preview-partners {
	width: 145px;
	height: 154px;
	position: absolute;
	top: 3px;
	left: 18px;
}

.img-partners {
	position: absolute;
	top: 3px;
	width: 143px;
	height: 154px;
	left: 19px;
	border-radius: 5px;
}


/*** end partners ***/


/*** User ***/

.position-user {
	position: absolute;
	right: 5px;
}

.preview-user {
	width: 145px;
	height: 154px;
	position: absolute;
	top: 3px;
	left: 18px;
}

.img-user {
	position: absolute;
	top: 3px;
	width: 143px;
	height: 154px;
	left: 19px;
	border-radius: 5px;
}


/*** end partners ***/


/*** Company ***/

.position-company {
	right: 10px;
}

.preview-company {
	width: 176px;
	height: 176px;
	position: absolute;
	top: 32px;
	left: 17px;
}

.img-company {
	position: absolute;
	top: 32px;
	width: 176px;
	height: 176px;
	left: 17px;
	border-radius: 5px;
}


/*** end Company ***/


/*** Company carrusel ***/

.preview-carrusel-1 {
	width: 489px;
	height: 145px;
	position: absolute;
	top: 122px;
	left: 23px;
}

.img-carrusel-1 {
	position: absolute;
	top: 122px;
	width: 489px;
	height: 145px;
	left: 23px;
	border-radius: 5px;
}

.preview-carrusel-2 {
	width: 490px;
	height: 145px;
	position: absolute;
	top: 180px;
	left: 23px;
}

.img-carrusel-2 {
	position: absolute;
	top: 180px;
	width: 489px;
	height: 145px;
	left: 23px;
	border-radius: 5px;
}

.preview-carrusel-3 {
	width: 489px;
	height: 145px;
	position: absolute;
	top: 180px;
	left: 23px;
}

.img-carrusel-3 {
	position: absolute;
	top: 180px;
	width: 489px;
	height: 145px;
	left: 23px;
	border-radius: 5px;
}


/*** end carrusel ***/

.hidden-img {
	display: none !important;
}

.main-content {
	background-color: #f4f4f4!important;
}

label {
	color: #58575b !important
}

aside {
	display: none !important
}

.ui-autocomplete {
	background-image: none;
	background-color: #fff;
	border: 1px solid #c2c2c2;
	border-radius: 3px;
	color: #424242;
	padding: 2px 4px;
	height: 30px;
	width: 100%
}

.ck-content p {
	color: #000000;
}

.ck-content {
	min-height: 500px !important
}

.btn-border {
	border-radius: 25px
}

.text-sidebar {
	color: #fff;
}

.navbar .navbar-item .nav-item form.form-inline input.search-form-control {
	background-color: #ffffff !important;
	color: #424242;
	border: solid;
}

.color-thead {
	background-color: #1a1c2d !important;
}

.form-fond {
	background-color: #fff !important;
}

.tr-text-pos {
	font-size: .9em;
	color: #424242
}

.tr-text {
	font-size: 1em;
	color: #424242
}

.widget {
	background-color: #FFFFFF !important
}

.card-title {
	color: #424242 !important
}

.connect-sorting {
	background-color: #1a1c2d !important
}

.btn-success {
	background-color: #5cb85c !important
}

.text-success {
	color: #5cb85c !important
}

.content-input input,
.content-select select {
	appearance: none;
	-webkit-appearance: none;
	-moz-appearance: none;
}

.content-input input {
	visibility: hidden;
	position: absolute;
	right: 0;
}

.content-input {
	position: relative;
	margin-bottom: 30px;
	padding: 5px 0 5px 60px;
	/* Damos un padding de 60px para posicionar



        el elemento <i> en este espacio*/
	display: block;
}


/* Estas reglas se aplicarán a todos las elementos idespués de cualquier input*/

.content-input input+i {
	background: #f0f0f0;
	border: 2px solid rgba(0, 0, 0, 0.2);
	position: absolute;
	left: 0;
	top: 0;
}


/* Estas reglas se aplicarán a todos los i despues de un input de tipo checkbox */

.content-input input[type=checkbox]+i {
	width: 52px;
	height: 30px;
	border-radius: 15px;
}

.content-input input[type=checkbox]+i:before {
	content: '';
	/* No hay contenido */
	width: 26px;
	height: 26px;
	background: #fff;
	border-radius: 50%;
	position: absolute;
	z-index: 1;
	left: 0px;
	top: 0px;
	-webkit-box-shadow: 3px 0 3px 0 rgba(0, 0, 0, 0.2);
	box-shadow: 3px 0 3px 0 rgba(0, 0, 0, 0.2);
}

.content-input input[type=checkbox]:checked+i:before {
	left: 22px;
	-webkit-box-shadow: -3px 0 3px 0 rgba(0, 0, 0, 0.2);
	box-shadow: 3px 0 -3px 0 rgba(0, 0, 0, 0.2);
}

.content-input input[type=checkbox]:checked+i {
	background: #2AC176;
}

.content-input input[type=checkbox]+i:after {
	content: 'ON';
	position: absolute;
	font-size: 10px;
	color: rgba(255, 255, 255, 0.6);
	top: 8px;
	left: 4px;
	opacity: 0
	/* Ocultamos este elemento */
	;
	transition: all 0.25s ease 0.25s;
}


/* Cuando esté checkeado cambiamos la opacidad a 1 y lo mostramos */

.content-input input[type=checkbox]:checked+i:after {
	opacity: 1;
}

.inicio {
	width: 0%
}

.final {
	width: 100%
}

.animacion {
	transition: all 2s ease .5s
}

hr {
	display: block;
	height: 1px;
	border: 0;
	border-top: 1px solid #fff;
	margin: 1em 0;
	padding: 0;
}

.total h4,
h5 {
	font-size: 18px
}

{{-- 5. MEDIA QUERIES RESPONSIVE --}}
{{--
 * Breakpoints:
 *   - Mobile: 220px-540px
 *   - Tablet: 542px-720px
 *   - Desktop: 768px-1024px
 * Adaptaciones para:
 *   - Tamaños de texto
 *   - Ocultación de elementos
 *   - Ajustes de tablas
--}}
@media (min-width:220px) and (max-width:540px) {
	.image-responsive {
		width: 25px;
		height: 25px;
	}
	.compo-title {
		font-size: 14px
	}
	.table-ecommerce {
		font-size: 10px
	}
	.btn-responsive {
		height: 30px !important;
		font-size: 10px !important
	}
	.color-thead {
		font-size: 10px
	}
	.tr-text {
		font-size: 10px !important
	}
	.d-xs-none {
		display: none !important;
	}
	.checkbox-primay {
		font-size: 10px
	}
	.table-th {
		font-size: 10px !important
	}
	.tr-text-pos {
		font-size: 10px !important
	}
	.total h4,
	h5 {
		font-size: 10px
	}
	.coins {
		font-size: 10px
	}
	.search {
		height: 30px !important
	}
}

@media (min-width:542px) and (max-width:720px) {
	.compo-title {
		font-size: 14px
	}
	.btn-responsive {
		height: 30px !important;
		font-size: 10px !important
	}
	.color-thead {
		font-size: 12px
	}
	.tr-text {
		font-size: 10px !important
	}
	.d-xs-none {
		display: none !important;
	}
	.checkbox-primay {
		font-size: 12px
	}
	.table-th {
		font-size: 12px !important
	}
	.tr-text-pos {
		font-size: 10px !important
	}
	.total h4,
	h5 {
		font-size: 12px
	}
	.coins {
		font-size: 10px
	}
	.search {
		height: 30px !important
	}
}

@media only screen and (min-width: 768px) and (max-width:1024px) {
	.compo-title {
		font-size: 14px
	}
	.btn-responsive {
		height: 30px !important;
		font-size: .8em !important
	}
	.color-thead {
		font-size: .8em !important
	}
	.tr-text {
		font-size: .8em !important
	}
	.d-xs-none {
		display: none !important;
	}
	.checkbox-primay {
		font-size: 10px
	}
	.table-th {
		font-size: .8em !important
	}
	.tr-text-pos {
		font-size: .8em !important
	}
	.total h4,
	h5 {
		font-size: 14px
	}
	.coins {
		font-size: .6em;
	}
	.search {
		height: 30px !important
	}
	.text-sidebar {
		font-size: .9em !important
	}
	.reports {
		font-size: .9em !important
	}
	.cashout {
		font-size: .9em !important
	}
}
</style>



@livewireStyles
