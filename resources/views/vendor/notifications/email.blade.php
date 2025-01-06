<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        /* Ensure the body and table are full width and centered */
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            font-family: Arial, sans-serif;
        }
        .wrapper {
            width: 100%;
            background-color: #f4f4f4; /* Background color if needed */
        }
        .content {
            width: 100%;
            background-color: #ffffff; /* Background color if needed */
            padding: 20px;
        }
        .header img {
            display: block; /* Remove extra space below the image */
            margin: 0 auto; /* Center the image */
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
<table class="wrapper" cellpadding="0" cellspacing="0" role="presentation">
    <tr>
        <td align="center">
            <table class="content" cellpadding="0" cellspacing="0" role="presentation">
                <tr>
                    <td class="header text-center">
                        <!-- Use absolute URL for the image -->
                        <a href="{{ config('app.url') }}">
                            <img src="https://mepcp.pesrp.edu.pk/images/MoECP.jpg" alt="Your Logo" style="width: auto; height: 7em; max-width: 100%;">
                        </a>
                    </td>
                </tr>

                <!-- Email Content -->
                <tr>
                    <td class="text-center">
                        <!-- Greeting -->
                        @if (! empty($greeting))
                            <h1>{{ $greeting }}</h1>
                        @else
                            @if ($level === 'error')
                                <h1>@lang('Whoops!')</h1>
                            @else
                                <h1>@lang('Hello!')</h1>
                            @endif
                        @endif

                        <!-- Intro Lines -->
                        @foreach ($introLines as $line)
                            <p>{{ $line }}</p>
                        @endforeach

                        <!-- Action Button -->
                        @isset($actionText)
                                <?php
                                $color = match ($level) {
                                    'success', 'error' => $level,
                                    default => 'primary',
                                };
                                ?>
                            <x-mail::button :url="$actionUrl" :color="$color">
                                {{ $actionText }}
                            </x-mail::button>
                        @endisset

                        <!-- Outro Lines -->
                        @foreach ($outroLines as $line)
                            <p>{{ $line }}</p>
                        @endforeach

                        <!-- Salutation -->
                        @if (! empty($salutation))
                            <p>{{ $salutation }}</p>
                        @else
                            <p>@lang('Regards'),<br>Team MECC</p>
                        @endif
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
