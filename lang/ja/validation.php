<?php

return [
    
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'        => ':attributeを承認してください。',
    'accepted_if'     => ':Otherが:valueの場合、:attributeを承認する必要があります。',
    'active_url'      => ':attributeは、有効なURLではありません。',
    'after'           => ':attributeには、:dateより後の日付を指定してください。',
    'after_or_equal'  => ':attributeには、:date以降の日付を指定してください。',
    'alpha'           => ':attributeには、アルファベッドのみ使用できます。',
    'alpha_dash'      => ":attributeには、英数字('A-Z','a-z','0-9')とハイフンと下線('-','_')が使用できます。",
    'alpha_num'       => ":attributeには、英数字('A-Z','a-z','0-9')が使用できます。",
    'array'           => ':attributeには、配列を指定してください。',
    'ascii'           => ':Attributeには、英数字と記号のみ使用可能です。',
    'before'          => ':attributeには、:dateより前の日付を指定してください。',
    'before_or_equal' => ':attributeには、:date以前の日付を指定してください。',
    'between' => [
        'numeric'  => ':attributeには、:minから、:maxまでの数字を指定してください。',
        'file'      => ':attributeには、:min KBから:max KBまでのサイズのファイルを指定してください。',
        'string'   => ':attributeは、:min文字から:max文字にしてください。',
        'array'    => ':attributeの項目は、:min個から:max個にしてください。',
    ],
    'boolean'           => ":attributeには、'true'か'false'を指定してください。",
    'can'               => ':Attribute フィールドには不正な値が含まれています。',
    'confirmed'          => ':attributeと:attribute確認が一致しません。',
    'current_password'  => 'パスワードが正しくありません。',
    'date'              => ':attributeは、正しい日付ではありません。',
    'date_equals'       => ':attributeは:dateに等しい日付でなければなりません。',
    'date_format'       => ":attributeの形式は、':format'と合いません。",
    'decimal'           => ':Attributeは、小数点以下が:decimalである必要があります。',
    'declined'          => ':Attributeを拒否する必要があります。',
    'declined_if'       => ':Otherが:valueの場合、:attributeを拒否する必要があります。',
    'different'         => ':attributeと:otherには、異なるものを指定してください。',
    'digits'            => ':attributeは、:digits桁にしてください。',
    'digits_between'    => ':attributeは、:min桁から:max桁にしてください。',
    'dimensions'        => ':attributeの画像サイズが無効です',
    'distinct'          => ':attributeの値が重複しています。',
    'doesnt_end_with'   => ':Attributeの終わりは「:values」以外である必要があります。',
    'doesnt_start_with' => ':Attributeの始まりは「:values」以外である必要があります。',
    'email'             => ':attributeは、有効なメールアドレス形式で指定してください。',
    'ends_with'         => ':attributeは、次のうちのいずれかで終わらなければなりません。: :values',
    'enum'              => '選択した :attributeは 無効です。',
    'exists'            => '選択された:attributeは、有効ではありません。',
    'file'               => ':attributeはファイルでなければいけません。',
    'filled'             => ':attributeは必須です。',
    'gt' => [
        'numeric'  => ':attributeは、:valueより大きくなければなりません。',
        'file'      => ':attributeは、:value KBより大きくなければなりません。',
        'string'   => ':attributeは、:value文字より大きくなければなりません。',
        'array'    => ':attributeの項目数は、:value個より大きくなければなりません。',
    ],
    'gte' => [
        'numeric' => ':attributeは、:value以上でなければなりません。',
        'file'     => ':attributeは、:value KB以上でなければなりません。',
        'string'  => ':attributeは、:value文字以上でなければなりません。',
        'array'   => ':attributeの項目数は、:value個以上でなければなりません。',
    ],
    'image'     => ':attributeには、画像を指定してください。',
    'in'        => '選択された:attributeは、有効ではありません。',
    'in_array'  => ':attributeが:otherに存在しません。',
    'integer'   => ':attributeには、整数を指定してください。',
    'ip'        => ':attributeには、有効なIPアドレスを指定してください。',
    'ipv4'      => ':attributeはIPv4アドレスを指定してください。',
    'ipv6'      => ':attributeはIPv6アドレスを指定してください。',
    'json'      => ':attributeには、有効なJSON文字列を指定してください。',
    'lowercase' =>  ':Attributeは、小文字で入力してください。',
    'lt' => [
        'numeric' => ':attributeは、:valueより小さくなければなりません。',
        'file'     => ':attributeは、:value KBより小さくなければなりません。',
        'string'  => ':attributeは、:value文字より小さくなければなりません。',
        'array'   => ':attributeの項目数は、:value個より小さくなければなりません。',
    ],
    'lte' => [
        'numeric' => ':attributeは、:value以下でなければなりません。',
        'file'     => ':attributeは、:value KB以下でなければなりません。',
        'string'  => ':attributeは、:value文字以下でなければなりません。',
        'array'   => ':attributeの項目数は、:value個以下でなければなりません。',
    ],
    'mac_address' => ':Attributeは有効なMACアドレスである必要があります。',
    'max' => [
        'numeric' => ':attributeには、:max以下の数字を指定してください。',
        'file'     => ':attributeには、:max KB以下のファイルを指定してください。',
        'string'  => ':attributeは、:max文字以下にしてください。',
        'array'   => ':attributeの項目は、:max個以下にしてください。',
    ],
    'max_digits' => ':Attributeは、:max桁以下の数字である必要があります。',
    'mimes'      => ':attributeには、:valuesタイプのファイルを指定してください。',
    'mimetypes'  => ':attributeには、:valuesタイプのファイルを指定してください。',
    'min' => [
        'numeric' => ':attributeには、:min以上の数字を指定してください。',
        'file'     => ':attributeには、:min KB以上のファイルを指定してください。',
        'string'  => ':attributeは、:min文字以上にしてください。',
        'array'   => ':attributeの項目は、:min個以上にしてください。',
    ],
    'min_digits'            => ':Attributeは、:min桁以上の数字である必要があります。',
    'missing'               => ':Attribute を入力する必要はありません。',
    'missing_if'            => ':Other が :value の場合、:attribute を入力する必要はありません。',
    'missing_unless'        => ':Other が :value でない限り、:attribute をは入力する必要はありません。',
    'missing_with'          => ':Values が存在する場合、:attribute をは入力する必要はありません。',
    'missing_with_all'      => ':Values が存在する場合、:attribute をは入力する必要はありません。',
    'multiple_of'           => ':Attributeは:valueの倍数である必要があります',
    'not_in'                => '選択された:attributeは、有効ではありません。',
    'not_regex'             => ':attributeの形式が無効です。',
    'numeric'               => ':attributeには、数字を指定してください。',
    'password' => [
        'letters'           => ':Attributeは文字を1文字以上含める必要があります。',
        'mixed'             => ':Attributeは大文字と小文字をそれぞれ1文字以上含める必要があります。',
        'numbers'           => ':Attributeは数字を1文字以上含める必要があります。',
        'symbols'           => ':Attributeは記号を1文字以上含める必要があります。',
        'uncompromised'     => ':Attributeは情報漏洩した可能性があります。他の:attributeを選択してください。',
    ],
    'present'               => ':attributeが存在している必要があります。',
    'prohibited'            => ':Attributeの入力は禁止されています。',
    'prohibited_if'         => ':Otherが:valueの場合は、:Attributeの入力が禁止されています。',
    'prohibited_unless'     => ':Otherが:valuesでない限り、:Attributeの入力は禁止されています。',
    'prohibits'             => ':Otherが存在している場合、:Attributeの入力は禁止されています。',
    'regex'                 => ':attributeには、有効な正規表現を指定してください。',
    'required'              => ':attributeは、必ず指定してください。',
    'required_array_keys'   => ':Attributeには、:valuesのエントリを含める必要があります。',
    'required_if'           => ':otherが:valueの場合、:attributeを指定してください。',
    'required_if_accepted'  => ':Otherを承認した場合、:attributeは必須項目です。',
    'required_unless'       => ':otherが:values以外の場合、:attributeを指定してください。',
    'required_with'         => ':valuesが指定されている場合、:attributeも指定してください。',
    'required_with_all'     => ':valuesが全て指定されている場合、:attributeも指定してください。',
    'required_without'      => ':valuesが指定されていない場合、:attributeを指定してください。',
    'required_without_all'  => ':valuesが全て指定されていない場合、:attributeを指定してください。',
    'same'                  => ':attributeと:otherが一致しません。',
    'size' => [
        'numeric' => ':attributeには、:sizeを指定してください。',
        'file'     => ':attributeには、:size KBのファイルを指定してください。',
        'string'  => ':attributeは、:size文字にしてください。',
        'array'   => ':attributeの項目は、:size個にしてください。',
    ],
    'starts_with' => ':attributeは、次のいずれかで始まる必要があります。:values',
    'string'      => ':attributeには、文字を指定してください。',
    'timezone'    => ':attributeには、有効なタイムゾーンを指定してください。',
    'unique'      => '指定の:attributeは既に使用されています。',
    'uploaded'    => ':attributeのアップロードに失敗しました。',
    'uppercase'   => ':Attributeは、大文字で入力してください。',
    'url'         => ':attributeは、有効なURL形式で指定してください。',
    'ulid'        => ':Attributeは、有効なULIDである必要があります。',
    'uuid'        => ':attributeは、有効なUUIDでなければなりません。',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention 'attribute.rule' to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as 'E-Mail Address' instead
    | of 'email'. This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],
    
];
