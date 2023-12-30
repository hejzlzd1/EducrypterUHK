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
                    <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
                    <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @lang("menuTexts.symetricAlgo")
                    </a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-item disabled">@lang('menuTexts.classicCiphers')</li>
                        <li><a class="dropdown-item" href="{{route('caesarCipher')}}">@lang('menuTexts.caesarCipher')</a></li>
                        <li><a class="dropdown-item" href="/todo">@lang('menuTexts.vernamCipher')</a></li>
                        <li><a class="dropdown-item" href="{{route('vigenereCipher')}}">@lang('menuTexts.vigenereCipher')</a></li>

                        <li><hr class="dropdown-divider"></li>
                        <li class="dropdown-item disabled">@lang('menuTexts.blockCiphers')</li>
                        <li><a class="dropdown-item" href="{{route('aesCipher')}}">AES</a></li>
                        <li><a class="dropdown-item" href="{{route('blowfishCipher')}}">Blowfish</a></li>
                        <li><a class="dropdown-item" href="{{route('simpleDesCipher')}}">Simple DES</a></li>
                        <li><a class="dropdown-item" href="/todo">TripleDES</a></li>

                        <li><hr class="dropdown-divider"></li>
                        <li class="dropdown-item disabled">@lang("menuTexts.streamCiphers")</li>
                        <li><a class="dropdown-item" href="{{route('a51')}}">A5/1</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @lang('menuTexts.asymetricAlgo')
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/todo">DSA</a></li>
                        <li><a class="dropdown-item" href="{{route('rsaCipher')}}">RSA</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @lang('menuTexts.cipherInformation')
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/todo">@lang('menuTexts.classicCiphers')</a></li>
                        <li><a class="dropdown-item" href="/todo">@lang("menuTexts.blockCiphers")</a></li>
                        <li><a class="dropdown-item" href="/todo">@lang("menuTexts.blockCiphersModes")</a></li>
                        <li><a class="dropdown-item" href="/todo">@lang("menuTexts.streamCiphers")</a></li>
                    </ul>
                </li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </div><!-- .navbar -->

    </div>
</nav><!-- End Header -->
