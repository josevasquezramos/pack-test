<?php

namespace JoseVasquezRamos\PackTest\Traits;

use JoseVasquezRamos\PackTest\Models\UserProfile;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait HasPackTestFeatures
{
    /**
     * Define la relación 1 a 1 con el UserProfile.
     */
    public function userProfile(): HasOne
    {
        return $this->hasOne(UserProfile::class);
    }

    /**
     * Método de ejemplo: Obtener el cargo del usuario.
     */
    public function getJobTitle(): ?string
    {
        // 'userProfile' usa la relación que definimos arriba
        return $this->userProfile?->job_title;
    }

    /**
     * Método de ejemplo: Actualizar el cargo.
     */
    public function updateJobTitle(string $newTitle): bool
    {
        // Si no tiene perfil, lo crea; si ya tiene, lo actualiza.
        return $this->userProfile()->updateOrCreate(
            ['user_id' => $this->id],
            ['job_title' => $newTitle]
        );
    }
}