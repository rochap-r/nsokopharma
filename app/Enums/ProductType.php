<?php

namespace App\Enums;

enum ProductType: string
{
    case Medicament = 'médicament';
    case Dispositif = 'dispositif';

    public function label(): string
    {
        // Vous pouvez décider ici : soit retourner une chaîne fixe
        /*return match($this) {
            self::Medicament   => 'Médicament',
            self::Dispositif   => 'Dispositif',
        };*/
        // OU, de manière dynamique, par exemple.
        return ucfirst($this->value);
    }

    //    <select name="type" id="type" class="form-select">
    //    @foreach(\App\Enums\ProductType::cases() as $enum)
    //    <option value="{{ $enum->value }}"
    //    {{ old('type', isset($product) ? $product->type->value : null) === $enum->value ? 'selected' : '' }}>
    //    {{ $enum->label() }}
    //    </option>
    //    @endforeach
    //    </select>

}
