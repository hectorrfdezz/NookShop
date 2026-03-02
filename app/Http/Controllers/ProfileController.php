<?php

namespace App\\Http\\Controllers;

use Illuminate\\Http\\Request;
use Illuminate\\Support\\Facades\\Auth;
use Illuminate\\Support\\Facades\\Http;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        $user = Auth::user();
        $weather = null;
        $alert = null;
        if ($user->latitude && $user->longitude) {
            $apiKey = config('services.openweather.key', env('OPENWEATHER_API_KEY'));
            $url = "https://api.openweathermap.org/data/2.5/weather?lat={$user->latitude}&lon={$user->longitude}&units=metric&lang=es&appid={$apiKey}";
            try {
                $response = Http::get($url)->json();
                if ($response && isset($response['weather'][0]['description'])) {
                    $weather = $response['weather'][0]['description'];
                    $main = strtolower($response['weather'][0]['main']);
                    if (in_array($main, ['rain', 'snow', 'thunderstorm'])) {
                        $alert = 'Se han detectado condiciones meteorológicas adversas en tu zona. Ten cuidado.';
                    }
                }
            } catch (\Exception $e) {
                $weather = null;
            }
        }
        return view('profile', compact('user', 'weather', 'alert'));
    }
    public function edit()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }
    public function update(Request $request)
    {
        $user = Auth::user();
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'address' => 'nullable|string|max:255',
        ]);
        $user->update($data);
        return redirect()->route('profile.edit')->with('success', 'Perfil actualizado correctamente.');
    }
}
