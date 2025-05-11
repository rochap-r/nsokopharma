<?php

namespace App\Enums;

enum PersonType: string
{
    case Enfant = 'enfant';
    case Adulte = 'adulte';

    public function label(): string
    {
        return match($this) {
            self::Enfant => 'Enfant',
            self::Adulte => 'Adulte',
        };
        // OU alternativement : return ucfirst($this->value);
    }

    //<select name="personne" id="personne" class="form-select">
    //@foreach(\App\Enums\PersonType::cases() as $enum)
    //<option value="{{ $enum->value }}"
    //{{ old('personne', isset($product) && $product->personne ? $product->personne->value : null) === $enum->value ? 'selected' : '' }}>
    //{{ $enum->label() }}
    //</option>
    //@endforeach
    //</select>

}
