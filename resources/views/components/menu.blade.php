<nav id="navbar" class="navbar sticky-top bg-white navbar-expand-lg shadow">
    <div class="container-fluid">
        <div class="logo" style="padding-left: 20px">
            <a class="navbar-brand" href="https://www.uhk.cz">
                <img src="https://www.uhk.cz/img/svg/logo/uhk-uhk-cs_hor.svg" height="40px" alt="Logo uhk" class="logoimg">
            </a>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggle" aria-controls="navbarToggle" aria-expanded="false" aria-label="Menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarToggle" style="padding-right: 20px;">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="/" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @lang("menuTexts.mainPage")
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/#intro">@lang("menuTexts.introInfo")</a></li>
                        <li><a class="dropdown-item" href="/#symetric">@lang("menuTexts.symetricAlgo")</a></li>
                        <li><a class="dropdown-item" href="/#asymetric">@lang("menuTexts.asymetricAlgo")</a></li>
                        <li><a class="dropdown-item" href="/#usage">@lang("menuTexts.cryptoUsage")</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="/#protocols">@lang("menuTexts.protocols")</a></li>
                        <li><a class="dropdown-item" href="/#sslvstls">SSL vs TLS</a></li>
                        <li><a class="dropdown-item" href="/#certificates">@lang("menuTexts.tscertificates")</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="/" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @lang("menuTexts.symetricAlgo")
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">@lang("menuTexts.caesarCipher")</a></li>
                        <li><a class="dropdown-item" href="#">@lang("menuTexts.vigenereCipher")</a></li>
                        <li><a class="dropdown-item" href="#">Blowfish</a></li>
                        <li><a class="dropdown-item" href="#">DES</a></li>
                        <li><a class="dropdown-item" href="#">AES</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="/" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @lang("menuTexts.asymetricAlgo")
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">RSA</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link" href="#">TODO</a></li>
                <li class="nav-item"><a class="nav-link" href="#">TODO</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </div><!-- .navbar -->

    </div>
</nav><!-- End Header -->
