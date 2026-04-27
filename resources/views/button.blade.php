{{--
    Bouton de connexion SSO ANPI-Gabon
    Usage : @include('vendor.anpi-sso.button')
         ou <x-anpi-sso::button />  (si vous déclarez le composant)
--}}
<a href="{{ route('auth.anpi') }}" class="btn-anpi {{ $class ?? '' }}" style="
    display: inline-flex;
    align-items: center;
    gap: .65rem;
    padding: .75rem 1.25rem;
    background: #1D4F91;
    color: #fff;
    border-radius: 8px;
    font-weight: 600;
    text-decoration: none;
    font-family: inherit;
    transition: background .15s ease;
">
    <span style="
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 26px;
        height: 26px;
        background: #fff;
        color: #1D4F91;
        border-radius: 50%;
        font-weight: 800;
        font-size: .9rem;
        flex-shrink: 0;
    ">A</span>
    {{ $slot ?? 'Se connecter avec ANPI-Gabon' }}
</a>
