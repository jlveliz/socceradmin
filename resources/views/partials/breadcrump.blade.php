<div class="breadcrumb">
	<h1>@yield('title')</h1>
	<ul>
		<li><a href="@yield('route-parent')">@yield('parent-page')</a></li>
		<li>@yield('current-page')</li>
	</ul>
</div>
<div class="separator-breadcrumb border-top"></div>