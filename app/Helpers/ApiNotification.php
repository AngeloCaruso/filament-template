<?php

namespace App\Helpers;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ApiNotification
{
    public static function sendEmail($name, $email, $subject, $content)
    {
        try {
            $request = Http::withToken(config('services.notifications_api.token'))
                ->post(config('services.notifications_api.url') . "/notificar-email", [
                    'destinatario' => $email,
                    'asunto' => $subject,
                    'from' => config('name'),
                    'contenido' => $content
                ]);

            if ($request->failed()) {
                throw new Exception('Error sending email');
            }

            return true;
        } catch (Exception $e) {
            Log::error($e->getMessage());
            Log::error($request->body());
            return false;
        }
    }

    public static function sendSms($phone, $message)
    {
        try {
            $request = Http::withToken(config('services.notifications_api.token'))
                ->post(config('services.notifications_api.url') . "/notificar-sms", [
                    'phone' => $phone,
                    'sms' => $message,
                    'sc' => 890202
                ]);

            if ($request->failed()) {
                throw new Exception('Error sending sms');
            }

            return true;
        } catch (Exception $e) {
            Log::error($e->getMessage());
            Log::error($request->body());
            return false;
        }
    }

    public static function sendWhatsapp($name, $phone, $message)
    {
        try {
            $request = Http::withToken(config('services.notifications_api.token'))
                ->post(config('services.notifications_api.url') . "/notificar-whatsapp", [
                    'name' => $name,
                    'to' => $phone,
                    'message' => $message
                ]);

            if ($request->failed()) {
                throw new Exception('Error sending whatsapp');
            }

            return true;
        } catch (Exception $e) {
            Log::error($e->getMessage());
            Log::error($request->body());
            return false;
        }
    }
}
