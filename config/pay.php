<?php

return [
    //支付宝配置项
    'alipay' => [
        'app_id'         => '2016080100139778',
        'ali_public_key' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAv0ORghBZ+LSLAlVhA+GVExVBQZWEAo1YBjAmBFaXg17s7jR+Q+e3AXmv/Hv8mN1B0Z2Dl44xAZjt/fgmo7LZmJaiLW2ZdiFBEZT6YqsBD0Dy9Ma9yWJAFL87d5f9ePfmlVEk0GcksMwSWATAqQ0laJjKdneIGO7kf27I/XK7JLozkAajd5A0abRfR9BWWXagYRAk/9uWVI81/92k3gSXrJLzdS3UR+Y+NlX3bwqGf2FwYugyySQk38DUkB0E29D7KlOpqUfqS/Xo6J164XWdUxIgLTUEE6DgN616fqi09g7GHDKeszL/9T7csiJljyVz2AAPl2ahGICpPaj+26zbEQIDAQAB',
        'private_key'    => 'MIIEpgIBAAKCAQEAvkq0UWpAh8Q8+cPj7iFocW87LJTSD84D7dMcNk9IenREheASZep3iVTmvzlv9MpkCm5VbGvXmcd+tctlqmYjP9+LCbq51p/2Mk59i7C4KFgItKo6gwAwVLl9e92i94fVISyTr2ScJeaEvoKbL0WkGQFQXEJoJV87cWsgZqdP4cCB1Zen8Nz9pQj6igWsIgH83SW5vMjV4X5McOc7+V0a89M56PGtAsihNREKeslf6fgo6iBi80w0CKKCH/zkNdNSHKZhZsOKDUcb/mPU5wIh7sPu5AdgiGsDoheHnhWzFA3VYqZCIuJSFoL4qYtZhmJH7Vz/s/jcSfmHTi+FG0T7zQIDAQABAoIBAQCQ9U+PhaVKx0675WHIkWKCpv0o5OVwbLvJe7xOEu9feRqJ8TuSr54H28k7eoGytEqpN4uTYEOJPdNkoWD9AXlwutWrv7a5rHlbsTcqJqDi+s0G83ZHPOmUYQkaRqhScAMHlnGadsYMiSIuDkgxJpfvBHU3Es9LSNR7fePczy+nBC+DeY5BW72AGbvHGSoBAbw8i/7UvFwGJ1TKn6lA9wAIz8MjVAnMbqeeXtYtGpMXRf9FIJ9nChMqgTVXV0+3wOoCIVYqXs4Sjq++zP14awISjrHek8hNAwCLsINIgQxyQYOu7l/ZPqALURc6mSt2yM8m6Nce8CCL5EwObeXZUSWBAoGBAPzPhfo1i7mJvg8/Eh1e/s8xyDPxBf3OyXOeqQf1QlRvatIllX9nFYdLe/ol6VYJPJ8Ue22A6RkJy0l5plRb2t20YBYj0SkSpe1Ku9TnLhxXhqBLO+6HbIybM6F02rgTO94D6AisGPOR7d/u/l2+5mWFvygXAXPDJASTp9LQ7f65AoGBAMCxRTbgAG/119oe43iju/UL/gaaNdNndkCTyLx+g5UbVIJ+bR1XJiCtBUxTuQE7sa4VEMNHOVqZADQSrME0xTAxKhbwYmNZ8PBHVTxrBGUacg9AdxFu5X6vLdOdHelI/SxjonqmhiCArfFuTwI4UIOKwJPoKg2UfXoZlt+QBXu1AoGBAJjCDIKTuEn0IRO1WIzGydEIk6BPEv+546ApTpmwaNP8Pt+cNik1cJy/z7nnDoceLbMx/SK9shue/2b2SrrOhgFQ7H50Rf47dmdbsQOEbShS+tYAn8YRrlWHsjrtEPwJIzOTyLD0zF7g3othLfIXV8AggNEIlagNUcYyMkYAWM6BAoGBAJoDlozb0b2rRBHFKo9cX3jnUuy4CVmlknDfLkzq2gUtyQhcQJ5477KiWF+/c1m2+rdngvRyUzdEn1L/sjDjGtEAGuIm1J0QYHHMsiYOa37b+lqSbhjzCF+PaROAu02g1yrJoC5kN0R3VZBpWKEvnbrmBjKyGBqumvQiy+J43MkZAoGBAIzc1PYdUTmVWjFDku2KK17uac0W9X1Fuj63/aRqqiRCOagsic1LdjFX8ND3WcROZzlJMFqNLxpY5GeQwlnQ/Z4Gdq9gFbsoIWfAvlpffV+KnPbQ/im8snMuHr24FVL0mS2ALPXkd/VHX9YvCDPcM2b8/k4Q9vIoAjDqOQwxx8kg',
        'log'            => [
            'file' => storage_path('logs/alipay.log'),
        ],
    ],

    'wechat' => [
        'app_id'      => '',
        'mch_id'      => '',
        'key'         => '',
        'cert_client' => '',
        'cert_key'    => '',
        'log'         => [
            'file' => storage_path('logs/wechat_pay.log'),
        ],
    ],
];
