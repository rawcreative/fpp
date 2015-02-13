<?php namespace FPP\Http\Controllers\Api\v1;

use FPP\Commands\SaveFPPSetting;
use FPP\Exceptions\FPPSettingsException;
use FPP\Http\Requests;
use FPP\Http\Controllers\Controller;

use FPP\Services\FPP;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    use DispatchesCommands;

    private $fpp;

    public function __construct(FPP $fpp)
    {
        $this->fpp = $fpp;
    }


    public function getAllSettings()
    {
        $settings = $this->fpp->getSettings();
        return response()->json(['response' => ['settings' => $settings]]);
    }

    public function getSetting($setting)
    {
        try {
            $value = $this->fpp->getSetting($setting);
            return response()->json(['response' => [$setting => $value]]);
        } catch (FPPSettingsException $e) {
            return response()->json(['error' => $e->getMessage()]);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update(Request $request, $setting)
    {

        $value = $request->json($setting);
        try {
            $command = new SaveFPPSetting($setting, $value);
            $this->dispatch($command);
            return response()->json(['response' => 'success']);
        } catch(FPPSettingsException $e) {
            return response()->json(['error' => $e->getMessage()]);
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}
