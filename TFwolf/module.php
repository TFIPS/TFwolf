<?php
class TFwolf extends IPSModule
{
    public function Create()
	{
        parent::Create();
        $this->ConnectParent("{C6D2AEB3-6E1F-4B2E-8E69-3A1A00246850}");

		$this->RegisterPropertyString("deviceTopic", "tfebus");

		if (!IPS_VariableProfileExists('TFC.deviceState')) 
		{
			IPS_CreateVariableProfile('TFC.deviceState', 1);
			IPS_SetVariableProfileIcon ('TFC.deviceState', 'Network');
			IPS_SetVariableProfileAssociation('TFC.deviceState', 0, 'Blockiert', 'Warning', 0xFF0000);
			IPS_SetVariableProfileAssociation('TFC.deviceState', 1, 'Offline', 'Power', 0xFF8800);
			IPS_SetVariableProfileAssociation('TFC.deviceState', 2, 'Verbunden', 'Plug', 0xFFFF00);
			IPS_SetVariableProfileAssociation('TFC.deviceState', 3, 'Wartet', 'Sleep', 0xFFFF00);
			IPS_SetVariableProfileAssociation('TFC.deviceState', 4, 'Aktiv', 'Repeat', 0x00FF00);
		}
		if (!IPS_VariableProfileExists('TFW.actState')) 
		{
			IPS_CreateVariableProfile('TFW.actState', 1);
			IPS_SetVariableProfileIcon ('TFW.actState', 'ArrowRight');
			IPS_SetVariableProfileAssociation('TFW.actState', 0, 'Nicht Heizen ohne Wasser (Standby)', 'Power', -1);
			IPS_SetVariableProfileAssociation('TFW.actState', 1, 'Nicht Heizen mit Wasser (Sommer)', 'Sun', -1);
			IPS_SetVariableProfileAssociation('TFW.actState', 2, 'Absenken ohne Wassser', 'Moon', -1);
			IPS_SetVariableProfileAssociation('TFW.actState', 3, 'Absenken mit Wasser', 'Tap', -1);
			IPS_SetVariableProfileAssociation('TFW.actState', 4, 'Heizen ohne Wasser', 'Radiator', -1);
			IPS_SetVariableProfileAssociation('TFW.actState', 5, 'Heizen mit Wasser', 'Flame', -1);
			IPS_SetVariableProfileAssociation('TFW.actState', 6, 'Dusche', 'Shower', -1);
		}
        if (!IPS_VariableProfileExists('TFW.stateBM')) 
		{
            IPS_CreateVariableProfile('TFW.stateBM', 1);
			IPS_SetVariableProfileIcon ('TFW.stateBM', 'Execute');
            IPS_SetVariableProfileAssociation('TFW.stateBM', 0, 'Service', 'Gear', -1);
			IPS_SetVariableProfileAssociation('TFW.stateBM', 1, 'Standby-Betrieb', 'Power', -1);
			IPS_SetVariableProfileAssociation('TFW.stateBM', 2, 'Automatikbetrieb', 'Clock', -1);
			IPS_SetVariableProfileAssociation('TFW.stateBM', 3, 'Heizbetrieb', 'Radiator', -1);
			IPS_SetVariableProfileAssociation('TFW.stateBM', 4, 'Absenkbetrieb', 'Moon', -1);
			IPS_SetVariableProfileAssociation('TFW.stateBM', 5, 'Sommerbetrieb', 'Sun', -1);
			IPS_SetVariableProfileAssociation('TFW.stateBM', 99, 'Warte auf Status', 'Hourglass', -1);
        }
		if (!IPS_VariableProfileExists('TFW.timePrg')) 
		{
            IPS_CreateVariableProfile('TFW.timePrg', 1);
			IPS_SetVariableProfileIcon ('TFW.timePrg', 'Clock');
            IPS_SetVariableProfileAssociation('TFW.timePrg', 0, 'Zeitprogramm 1', 'Database', -1);
			IPS_SetVariableProfileAssociation('TFW.timePrg', 1, 'Zeitprogramm 2', 'Database', -1);
			IPS_SetVariableProfileAssociation('TFW.timePrg', 2, 'Zeitprogramm 3', 'Database', -1);
			IPS_SetVariableProfileAssociation('TFW.timePrg', 99, 'Warte auf Status', 'Hourglass', -1);
		}
		if (!IPS_VariableProfileExists('TFW.heating')) 
		{
            IPS_CreateVariableProfile('TFW.heating', 1);
            IPS_SetVariableProfileAssociation('TFW.heating', 0, 'Brenner ausschalten', 'Power', -1);
			IPS_SetVariableProfileAssociation('TFW.heating', 1, 'Keine Aktion', 'Power', -1);
			IPS_SetVariableProfileAssociation('TFW.heating', 2, 'Brauchwasserbereitung', 'Shower', -1);
			IPS_SetVariableProfileAssociation('TFW.heating', 3, 'Heizbetrieb', 'Sun', -1);
			IPS_SetVariableProfileAssociation('TFW.heating', 4, 'Emissionskontrolle', 'Gear', -1);
			IPS_SetVariableProfileAssociation('TFW.heating', 5, 'TÜV-Funktion', 'Gear', -1);
			IPS_SetVariableProfileAssociation('TFW.heating', 6, 'Reglerstop-Funktion', 'Cross', -1);
			IPS_SetVariableProfileAssociation('TFW.heating', 7, 'Brauchwasserbereitung bei Reglerstop', '', -1);
			IPS_SetVariableProfileAssociation('TFW.heating', 8, 'Brauchwasserbereitung bei Heizbetrieb', 'Bath', -1);
			IPS_SetVariableProfileAssociation('TFW.heating', 9, 'Reglerstop-Funktion bei stufigem Betrieb', '', -1);
		}
		
		if (!IPS_VariableProfileExists('TFW.burner')) 
		{
            IPS_CreateVariableProfile('TFW.burner', 0);
			IPS_SetVariableProfileIcon ('TFW.burner', 'Flame');
            IPS_SetVariableProfileAssociation('TFW.burner', false, 'Aus', 'Power', -1);
			IPS_SetVariableProfileAssociation('TFW.burner', true, 'An', 'Flame', -1);
		}
		
		if (!IPS_VariableProfileExists('TFW.uwp')) 
		{
            IPS_CreateVariableProfile('TFW.uwp', 0);
			IPS_SetVariableProfileIcon ('TFW.uwp', 'TurnRight');
            IPS_SetVariableProfileAssociation('TFW.uwp', false, 'Aus', 'Power', -1);
			IPS_SetVariableProfileAssociation('TFW.uwp', true, 'An', 'TurnRight', -1);
		}			
		
		if (!IPS_VariableProfileExists('TFW.customer')) 
		{
            IPS_CreateVariableProfile('TFW.customer', 1);
            IPS_SetVariableProfileAssociation('TFW.customer', 0, 'Keine Aktion', 'Power', -1);
			IPS_SetVariableProfileAssociation('TFW.customer', 1, 'Ausschalten Kesselpumpe', '', -1);
			IPS_SetVariableProfileAssociation('TFW.customer', 2, 'Einschalten Kesselpumpe', '', -1);
			IPS_SetVariableProfileAssociation('TFW.customer', 3, 'Ausschalten variabler Verbraucher', '', -1);
			IPS_SetVariableProfileAssociation('TFW.customer', 4, 'Einschalten variabler Verbraucher', '', -1);
		}
		if (!IPS_VariableProfileExists('TFW.actWeekplan')) 
		{
            IPS_CreateVariableProfile('TFW.actWeekplan', 1);
            IPS_SetVariableProfileAssociation('TFW.actWeekplan', 0, 'Normal', 'Ok', -1);
			IPS_SetVariableProfileAssociation('TFW.actWeekplan', 1, 'Urlaub', 'Wellness', -1);
			IPS_SetVariableProfileAssociation('TFW.actWeekplan', 2, 'Abwesend', 'Power', -1);
		}
		
		$this->RegisterPropertyFloat("tempJump", 0.3);
		$this->RegisterPropertyFloat("tempShowerOff", 40.0);
    }
    
    public function ApplyChanges()
	{
        parent::ApplyChanges();
		$actState_ID	= $this->RegisterVariableInteger("actState", "Aktueller Mode (Soll)", "TFW.actState", 10);
		// 5022
		$stateBM_ID		= $this->RegisterVariableInteger("stateBM", "Betriebsart", "TFW.stateBM", 11);
		$tempSW_ID		= $this->RegisterVariableFloat("tempSW", "Sommer- / Winterumschaltung", "~Temperature", 12);
		$tempDay_ID		= $this->RegisterVariableFloat("tempDay", "Tagtemperatur", "~Temperature", 13);
		$tempEco_ID		= $this->RegisterVariableFloat("tempEco", "Spartemperatur", "~Temperature", 14);
		$tempRoom_ID	= $this->RegisterVariableFloat("tempRoom", "Raumtemperatur", "~Temperature", 15);
		$tempKS_ID		= $this->RegisterVariableFloat("tempKS", "Kesseltemperatur Soll", "~Temperature", 16);
		$tempKI_ID		= $this->RegisterVariableFloat("tempKI", "Kesseltemperatur Ist", "~Temperature", 17);
		$tempWW_ID		= $this->RegisterVariableFloat("tempWW", "Eingestellte Warmwassertemperatur", "~Temperature", 18);
		$tempWWS_ID		= $this->RegisterVariableFloat("tempWWS", "Warmwassertemperatur Soll", "~Temperature", 19);
		$tempWWI_ID		= $this->RegisterVariableFloat("tempWWI", "Warmwassertemperatur Ist", "~Temperature", 20);
		$curTimePrg_ID	= $this->RegisterVariableInteger("curTimePrg", "Zeitprogramm", "TFEB.timePrg", 21);
		$burnerH_ID		= $this->RegisterVariableInteger("burnerH", "Brennerstunden", "Time", 27);
		$burnerS_ID		= $this->RegisterVariableInteger("burnerS", "Brennerstarts", "", 28);
		$onH_ID			= $this->RegisterVariableInteger("onH", "Betriebsstunden", "Time", 29);
		$flame_ID		= $this->RegisterVariableBoolean("flame", "Flamme", "TFW.burner", 30);
		$uwp_ID			= $this->RegisterVariableBoolean("uwp", "Umwälzpumpe", "TFW.uwp", 31);
		$tempA_ID		= $this->RegisterVariableFloat("tempA", "Außentemperatur", "~Temperature", 32);
		
		// 0700
		$time_ID		= $this->RegisterVariableString("time", "Uhrzeit", "", 33);
		$weekday_ID		= $this->RegisterVariableInteger("weekday", "Wochentag", "Weekday", 34);
		
		// 0507
		$heating_ID		= $this->RegisterVariableInteger("heating", "Heizungsstatus", "TFW.heating", 35);
		$customer_ID	= $this->RegisterVariableInteger("customer", "Verbraucherstatus", "TFW.customer", 36);

		$showerDetect_ID= $this->RegisterVariableBoolean("showerDetect", "Duscherkennung", "~Switch", 37);
		$shower_ID		= $this->RegisterVariableBoolean("shower", "Duschen", "~Switch", 37);
		$actWeekplan_ID = $this->RegisterVariableInteger("actWeekplan", "Aktiver Wochenplan", "TFW.actWeekplan", 38);

		// TFcloud - DeviceState
		$deviceState_ID	= $this->RegisterVariableInteger("deviceState", "Status", "TFC.deviceState", 95);
		$uptime_ID		= $this->RegisterVariableString("uptime", "Uptime", "", 96);
		$fVersion_ID	= $this->RegisterVariableString("fVersion", "Version", "", 97);
		$ipAddress_ID	= $this->RegisterVariableString("ipAddress", "IP-Adresse", "", 98);
		$wlanSignal_ID	= $this->RegisterVariableInteger("wlanSignal", "WLAN-Signal", "~Intensity.100", 99);
		
		// Wochenpläne
		if(!$heatplan1 = @IPS_GetObjectIDByIdent("heatplan1", $this->InstanceID))
		{
			$heatplan1 = IPS_CreateEvent(2);
			IPS_SetParent($heatplan1, $this->InstanceID);
			IPS_SetIdent($heatplan1, "heatplan1");
			IPS_SetName($heatplan1, "Heizprogramm (Normal)");
			IPS_SetPosition($heatplan1, 80);
			IPS_SetEventScheduleGroup($heatplan1, 0, 1);
			IPS_SetEventScheduleGroup($heatplan1, 1, 2);
			IPS_SetEventScheduleGroup($heatplan1, 2, 4);
			IPS_SetEventScheduleGroup($heatplan1, 3, 8);
			IPS_SetEventScheduleGroup($heatplan1, 4, 16);
			IPS_SetEventScheduleGroup($heatplan1, 5, 32);
			IPS_SetEventScheduleGroup($heatplan1, 6, 64);
			IPS_SetEventScheduleAction($heatplan1, 0, "Aus", 0x0000FF, "TFW_WSet(".$this->InstanceID.", 'hw', 0);");
			IPS_SetEventScheduleAction($heatplan1, 1, "Absenken", 0x00FFFF, "TFW_WSet(".$this->InstanceID.", 'h', 2);");
			IPS_SetEventScheduleAction($heatplan1, 2, "Heizen", 0xFFBF00, "TFW_WSet(".$this->InstanceID.", 'h', 1);");
			IPS_SetEventScheduleAction($heatplan1, 3, "Wasser", 0xBF00FF, "TFW_WSet(".$this->InstanceID.", 'w', 1);");
			IPS_SetEventScheduleAction($heatplan1, 4, "Heizen und Wasser", 0xFF0000, "TFW_WSet(".$this->InstanceID.", 'hw', 1);");
			IPS_SetEventScheduleAction($heatplan1, 5, "Absenken und Wasser", 0xFFFF00, "TFW_WSet(".$this->InstanceID.", 'hw', 21);");
		}
		if(!$heatplan2 = @IPS_GetObjectIDByIdent("heatplan2", $this->InstanceID))
		{
			$heatplan2 = IPS_CreateEvent(2);
			IPS_SetParent($heatplan2, $this->InstanceID);
			IPS_SetIdent($heatplan2, "heatplan2");
			IPS_SetName($heatplan2, "Heizprogramm (Urlaub)");
			IPS_SetPosition($heatplan2, 81);
			IPS_SetEventScheduleGroup($heatplan2, 0, 127);
			IPS_SetEventScheduleAction($heatplan2, 0, "Aus", 0x0000FF, "TFW_WSet(".$this->InstanceID.", 'hw', 0);");
			IPS_SetEventScheduleAction($heatplan2, 1, "Absenken", 0x00FFFF, "TFW_WSet(".$this->InstanceID.", 'h', 2);");
			IPS_SetEventScheduleAction($heatplan2, 2, "Heizen", 0xFFBF00, "TFW_WSet(".$this->InstanceID.", 'h', 1);");
			IPS_SetEventScheduleAction($heatplan2, 3, "Wasser", 0xBF00FF, "TFW_WSet(".$this->InstanceID.", 'w', 1);");
			IPS_SetEventScheduleAction($heatplan2, 4, "Heizen und Wasser", 0xFF0000, "TFW_WSet(".$this->InstanceID.", 'hw', 1);");
			IPS_SetEventScheduleAction($heatplan2, 5, "Absenken und Wasser", 0xFFFF00, "TFW_WSet(".$this->InstanceID.", 'hw', 21);");
		}
		if(!$heatplan3 = @IPS_GetObjectIDByIdent("heatplan3", $this->InstanceID))
		{
			$heatplan3 = IPS_CreateEvent(2);
			IPS_SetParent($heatplan3, $this->InstanceID);
			IPS_SetIdent($heatplan3, "heatplan3");
			IPS_SetName($heatplan3, "Heizprogramm (Abwesend)");
			IPS_SetPosition($heatplan3, 82);
			IPS_SetEventScheduleGroup($heatplan3, 0, 127);
			IPS_SetEventScheduleAction($heatplan3, 0, "Aus", 0x0000FF, "TFW_WSet(".$this->InstanceID.", 'hw', 0);");
			IPS_SetEventScheduleAction($heatplan3, 1, "Absenken", 0x00FFFF, "TFW_WSet(".$this->InstanceID.", 'h', 2);");
			IPS_SetEventScheduleAction($heatplan3, 2, "Heizen", 0xFFBF00, "TFW_WSet(".$this->InstanceID.", 'h', 1);");
			IPS_SetEventScheduleAction($heatplan3, 3, "Wasser", 0xBF00FF, "TFW_WSet(".$this->InstanceID.", 'w', 1);");
			IPS_SetEventScheduleAction($heatplan3, 4, "Heizen und Wasser", 0xFF0000, "TFW_WSet(".$this->InstanceID.", 'hw', 1);");
			IPS_SetEventScheduleAction($heatplan3, 5, "Absenken und Wasser", 0xFFFF00, "TFW_WSet(".$this->InstanceID.", 'hw', 21);");
		}
		$setActualMod_ID = $this->RegisterVariableBoolean("setActualMod", "Modus nach Wochenplan aktivieren", "~Switch", 86);		

		IPS_SetIcon($burnerS_ID, "Graph");
		IPS_SetIcon($time_ID, "Clock");
		IPS_SetIcon($weekday_ID, "Calendar");
		IPS_SetIcon($showerDetect_ID, "Eyes");
		IPS_SetIcon($shower_ID, "Shower");
		IPS_SetIcon($actWeekplan_ID, "Database");
		IPS_SetIcon($setActualMod_ID, "Hollowdoublearrowright");
		
		$this->EnableAction("stateBM");
		$this->EnableAction("curTimePrg");
		$this->EnableAction("showerDetect");
		$this->EnableAction("shower");
		$this->EnableAction("actWeekplan");
		$this->EnableAction("setActualMod");

		if (IPS_GetKernelRunlevel() != KR_READY) 
		{
            $this->RegisterMessage(0, IPS_KERNELSTARTED);
        }

		$this->RegisterMessage($tempWWI_ID, VM_UPDATE);
		$this->RegisterMessage($shower_ID, VM_UPDATE);
		$this->RegisterMessage($deviceState_ID, VM_UPDATE);
    }
	
	public function MessageSink($time, $sender, $message, $data) 
	{
		//IPS_LogMessage("MessageSink", "Message from SenderID ".$sender." with Message ".$message."\r\n Data: ".print_r($data, true));
		switch($message) 
		{
			case IPS_KERNELSTARTED:
				$this->WSet('hw', 3);
				if($this->GetValue("shower"))
				{
					if($this->GetValue("tempWWI") >= $this->ReadPropertyFloat("tempShowerOff"))
					{
						$this->SetValue("shower", false);
					}
					else
					{
						$this->SetValue("shower", true);
					}
				}
			break;

			case VM_UPDATE: 
				$ident = IPS_GetObject($sender)["ObjectIdent"];
				switch($ident)
				{
					case "shower":
						if(!$data[2] && $data[0])
						{
							$this->RequestAction("stateBM", 3);
							$actState = "Heizen (DUSCHE)";
							if($this->GetValue("actState") != 6) {$this->SetValue("actState", 6); }
						}
						if($data[2] && !$data[0])
						{
							$this->WSet('hw', 3);
						}
					break;
					case "tempWWI":
						if($this->GetValue("tempWWI") >= $this->ReadPropertyFloat("tempShowerOff") && $this->GetValue("shower"))
						{
							$this->SetValue("shower", false);
						}
						else
						{
							if($this->GetValue("showerDetect"))
							{
								$sek = $data[3] - $data[4];
								$jump= $data[2] - $data[0];
								$this->SetValue("TempSek", $sek); #TEST
								if($jump > 0 && $jump >= $this->ReadPropertyFloat("tempJump") && $jump < 6 && $data[0] < $this->ReadPropertyFloat("tempShowerOff") && !$this->GetValue("shower") && $this->GetValue("stateBM") != 3)
								{
									$this->SetValue("shower", true);
									$this->SetValue("TempJump", $jump); # TEST
								}
							}	 
						}
					break;
					case "deviceState":
						if($data[0] == 4 && $data[0] != $data[2])
						{
							// Wenn TFeBus-Adapter wieder Aktiv ist
							$this->WSet('hw', 3);
						}
					break;
				}
			break;
			/*
			case EM_UPDATE:
				if(IPS_GetEvent($sender)["EventActive"])
				{
					//IPS_LogMessage("MessageSink", "Message from SenderID ".$sender." with Message ".$message."\r\n Data: ".print_r($data, true));
					//$this->WSet('hw', 3);
				}
			break;
			*/
		}
	}
	
	public function WSet(string $setObject, int $state)
	{
		// State
		# 0 = Off
		# 1 = On
		# 2 = Low
		# 3 = Heatplan
		# hw can be 2 states
		$this->SendDebug("WSet", "SetObject: ".$setObject." - State: ".$state, 0);
		if($state == 3)
		{
			switch($this->GetValue("actWeekplan"))
			{
				case 0 :
					$heatplan_ID 	= IPS_GetObjectIDByIdent("heatplan1", $this->InstanceID);
				break;
				case 1 :
					$heatplan_ID 	= IPS_GetObjectIDByIdent("heatplan2", $this->InstanceID);
				break;
				case 2 :
					$heatplan_ID 	= IPS_GetObjectIDByIdent("heatplan3", $this->InstanceID);
				break;
			}
			switch($this->GetActualWeekplanAction($heatplan_ID))
			{
				case 0:
					$hAction = 0;
					$wAction = 0;
				break;
				case 1:
					$hAction = 2;
					$wAction = 0;
				break;
				case 2:
					$hAction = 1;
					$wAction = 0;
				break;
				case 3:
					$hAction = 0;
					$wAction = 1;
				break;
				case 4:
					$hAction = 1;
					$wAction = 1;
				break;
				case 5:
					$hAction = 2;
					$wAction = 1;
				break;
			}

			if($setObject == "h")
			{
				$wAction = 0;
			}
			if($setObject == "w")
			{
				$hAction = 0;
			}
		}
		else
		{
			if($setObject == "h")
			{
				$hAction = $state;
				$wAction = 0;
			}
			else if($setObject == "w")
			{
				$hAction = 0;
				$wAction = $state;
			}
			else if($setObject == "hw")
			{
				if(strlen($state) == 1)
				{
					switch($state)
					{
						case 0 :
							$hAction = 0;
							$wAction = 0;
						break;
						case 1 :
							$hAction = 1;
							$wAction = 1;
						break;
						case 2 :
							$hAction = 2;
							$wAction = 0;
						break;
					}
				}
				else if(strlen($state) == 2)
				{
					$states 	= str_split($state);
					$hAction 	= $states[0];
					$wAction 	= $states[1];
				}
			}
		}
		// Set Wolf
		$this->SendDebug("WSet", "Heizung: ".$hAction." - Wasser: ".$wAction, 0);
		if(!$this->GetValue("shower"))
		{
			switch($hAction)
			{
				case 0:
					switch($wAction)
					{
						case 0: //Nicht Heizen ohne Wasser -> Standby
							$this->SendCMD("setPH1_1_B1", 8080);
							$this->SendCMD("setPH1_2_B1", 8080);
							$this->SendCMD("setPW1_1_B1", 8080);
							$this->SendCMD("setPW1_2_B1", 8080);
							if($this->GetValue("stateBM") != 1) 	{ $this->RequestAction("stateBM", 1); }
							if($this->GetValue("curTimePrg") != 0) 	{ $this->RequestAction("curTimePrg", 0); }
							
							$actState = "Nicht Heizen ohne Wasser -> Standby";
							if($this->GetValue("actState") != 0) {$this->SetValue("actState", 0); }
						break;
						case 1: //Nicht Heizen mit Wasser -> Sommer
							$this->SendCMD("setPH1_1_B1", 8080);
							$this->SendCMD("setPH1_2_B1", 8080);
							$this->SendCMD("setPW1_1_B1", 6000);
							$this->SendCMD("setPW1_2_B1", 6000);

							if($this->GetValue("stateBM") != 5) 	{ $this->RequestAction("stateBM", 5); }
							if($this->GetValue("curTimePrg") != 0) 	{ $this->RequestAction("curTimePrg", 0); }
							
							$actState = "Nicht Heizen mit Wasser -> Sommer";
							if($this->GetValue("actState") != 1) {$this->SetValue("actState", 1); }
						break;
					}
				break;
				case 1:
					switch($wAction)
					{
						case 0: //Heizen ohne Wasser
							$this->SendCMD("setPH1_1_B1", 6000);
							$this->SendCMD("setPH1_2_B1", 6000);
							$this->SendCMD("setPW1_1_B1", 8080);
							$this->SendCMD("setPW1_2_B1", 8080);

							if($this->GetValue("stateBM") != 2) 	{ $this->RequestAction("stateBM", 2); }
							if($this->GetValue("curTimePrg") != 0) 	{ $this->RequestAction("curTimePrg", 0); }

							$actState = "Heizen ohne Wasser";
							if($this->GetValue("actState") != 4) {$this->SetValue("actState", 4); }
						break;
						case 1: //Heizen mit Wasser
							$this->SendCMD("setPH1_1_B1", 6000);
							$this->SendCMD("setPH1_2_B1", 6000);
							$this->SendCMD("setPW1_1_B1", 6000);
							$this->SendCMD("setPW1_2_B1", 6000);

							if($this->GetValue("stateBM") != 2) 	{ $this->RequestAction("stateBM", 2); }
							if($this->GetValue("curTimePrg") != 0) 	{ $this->RequestAction("curTimePrg", 0); }

							$actState = "Heizen mit Wasser";
							if($this->GetValue("actState") != 5) {$this->SetValue("actState", 5); }
						break;
					}
				break;
				case 2:
					switch($wAction)
					{
						case 0: //Absenken ohne Wassser
							$this->SendCMD("setPH1_1_B1", 8080);
							$this->SendCMD("setPH1_2_B1", 8080);
							$this->SendCMD("setPW1_1_B1", 8080);
							$this->SendCMD("setPW1_2_B1", 8080);

							if($this->GetValue("stateBM") != 2) 	{ $this->RequestAction("stateBM", 2); }
							if($this->GetValue("curTimePrg") != 0) 	{ $this->RequestAction("curTimePrg", 0); }

							$actState = "Absenken ohne Wassser";
							if($this->GetValue("actState") != 2) {$this->SetValue("actState", 2); }
						break;
						case 1: //Absenken mit Wasser
							$this->SendCMD("setPH1_1_B1", 8080);
							$this->SendCMD("setPH1_2_B1", 8080);
							$this->SendCMD("setPW1_1_B1", 6000);
							$this->SendCMD("setPW1_2_B1", 6000);

							if($this->GetValue("stateBM") != 2) 	{ $this->RequestAction("stateBM", 2); }
							if($this->GetValue("curTimePrg") != 0) 	{ $this->RequestAction("curTimePrg", 0); }

							$actState = "Absenken mit Wasser";
							if($this->GetValue("actState") != 3) {$this->SetValue("actState", 3); }
						break;
					}
				break;
			}
		}
	}

	function GetActualWeekplanAction($event_ID)
	{
		$value = 9;
		if($event_ID > 0)
		{
			$e = IPS_GetEvent($event_ID);
			if($e['EventActive'])
			{
				foreach($e['ScheduleGroups'] as $g) 
				{
					if(($g['Days'] & pow(2, date('N')-1)) > 0)
					{
						foreach($g['Points'] as $p) 
						{
							$start = mktime($p['Start']['Hour'], $p['Start']['Minute'], $p['Start']['Second']);
							if(time() >= $start)
							{
								$value = $p['ActionID'];
							}
							if($start >= time())
							{
								break;
							}
						}
						break;
					}
				}
			}
			else
			{
				$value = 0;
			}
		}
		return $value;
	}

	public function Test()
	{
		//echo $this->ReadPropertyFloat("tempJump");
		$this->WSet('hw', 3);
	}
		
	public function ReceiveData($JSONString)
    {
		$data = json_decode($JSONString, true);
		if($data['DataID'] == '{7F7632D9-FA40-4F38-8DEA-C83CD4325A32}')
		{
			$deviceTopic	= $this->ReadPropertyString("deviceTopic");
			$topic			= explode('/', $data['Topic']);
			
			if($topic[0] == $deviceTopic)
			{
				switch($topic[1])
				{
					case "eBusData":
						$this->SendDebug("eBusData", $data["Payload"], 0);
						$eBusData = json_decode($data["Payload"], true);
						if(array_key_exists('getStateBM', $eBusData))
						{
							switch($eBusData["getStateBM"])
							{
								case '00' : $valueBM = 0;break;
								case '01' : $valueBM = 1;break;
								case '02' : $valueBM = 2;break;
								case '03' : $valueBM = 3;break;
								case '04' : $valueBM = 4;break;
								case '05' : $valueBM = 5;break;
								case '0e' :	$valueBM = 14;break;
							}
							$this->SetValue("stateBM", $valueBM);

						}
						array_key_exists('getTempSW', $eBusData) ? $this->SetValue("tempSW", $eBusData["getTempSW"]) : 1;
						array_key_exists('getTempDay', $eBusData) ? $this->SetValue("tempDay", $eBusData["getTempDay"]) : 1;
						array_key_exists('getTempEco', $eBusData) ? $this->SetValue("tempEco", $eBusData["getTempEco"]) : 1;
						array_key_exists('getTempRoom', $eBusData) ? $this->SetValue("tempRoom", $eBusData["getTempRoom"]) : 1;
						array_key_exists('getTempKS', $eBusData) ? $this->SetValue("tempKS", $eBusData["getTempKS"]) : 1;
						array_key_exists('getTempKI', $eBusData) ? $this->SetValue("tempKI", $eBusData["getTempKI"]) : 1;
						array_key_exists('getCurTimePrg', $eBusData) ? $this->SetValue("curTimePrg", $eBusData["getCurTimePrg"]) : 1;
						array_key_exists('getBurnerH', $eBusData) ? $this->SetValue("burnerH", $eBusData["getBurnerH"]) : 1;
						array_key_exists('getBurnerS', $eBusData) ? $this->SetValue("burnerS", $eBusData["getBurnerS"]) : 1;
						array_key_exists('getOnH', $eBusData) ? $this->SetValue("onH", $eBusData["getOnH"]) : 1;
						array_key_exists('getTempA', $eBusData) ? $this->SetValue("tempA", $eBusData["getTempA"]) : 1;
						array_key_exists('getTempWW', $eBusData) ? $this->SetValue("tempWW", $eBusData["getTempWW"]) : 1;
						array_key_exists('getTempWWS', $eBusData) ? $this->SetValue("tempWWS", $eBusData["getTempWWS"]) : 1;
						array_key_exists('tempWWI', $eBusData) ? $this->SetValue("tempWWI", $eBusData["tempWWI"]) : 1;

						if(array_key_exists('valuesF', $eBusData))
						{
							$valuesF	= str_split($eBusData["valuesF"]);
							$uwp 		= boolval($valuesF[1]);
							$flame 		= boolval($valuesF[4]);
							$this->SetValue("uwp", $uwp);
							$this->SetValue("flame", $flame);
						}

						if(array_key_exists('valuesBM', $eBusData))
						{
							$valuesBM	= str_split($eBusData["valuesBM"], 2);
							$time 		= $valuesBM[0].':'.$valuesBM[1];
							$weekday 	= $valuesBM[2];

							$this->SetValue("time", $time);
							$this->SetValue("weekday", $weekday);
						}
						
						if(array_key_exists('valuesH', $eBusData))
						{
							$valuesH	= str_split($eBusData["valuesH"], 2);						
							switch($valuesH[0])
							{
								case "00" : $this->SetValue("heating", 0); break; // Brenner ausschalten
								case "01" : $this->SetValue("heating", 1); break; // Keine Aktion
								case "55" : $this->SetValue("heating", 2); break; // Brauchwasserbereitung
								case "AA" : $this->SetValue("heating", 3); break; // Heizbetrieb
								case "CC" : $this->SetValue("heating", 4); break; // Emissionskontrolle
								case "DD" : $this->SetValue("heating", 5); break; // TÜV-Funktion
								case "EE" : $this->SetValue("heating", 6); break; // Reglerstop-Funktion
								case "66" : $this->SetValue("heating", 7); break; // Brauchwasserbereitung bei Reglerstop
								case "BB" : $this->SetValue("heating", 8); break; // Brauchwasserbereitung bei Heizbetrieb
								case "44" : $this->SetValue("heating", 9); break; // Reglerstop-Funktion bei stufigem Betrieb
							}
							switch($valuesH[1])
							{
								case "00" : $this->SetValue("customer", 0); break; // Keine Aktion
								case "01" : $this->SetValue("customer", 1); break; // Ausschalten Kesselpumpe
								case "02" : $this->SetValue("customer", 2); break; // Einschalten Kesselpumpe
								case "03" : $this->SetValue("customer", 3); break; // Ausschalten variabler Verbraucher
								case "04" : $this->SetValue("customer", 4); break; // Einschalten variabler Verbraucher
							}
						}
					break;
				}
			
				/*
				case "will" :
					$valueData["will"] == "offline" && $this->GetValue("state") ? $this->SetValue("state", false) : 1;
				break;
				*/
			}
		}        
    }
	
	public function SendCMD(string $command, string $value)
	{
		$data['DataID'] 			= '{043EA491-0325-4ADD-8FC2-A30C8EEB4D3F}';
        $data['PacketType'] 		= 3;
        $data['QualityOfService'] 	= 0;
        $data['Retain'] 			= false;
		$data['Topic'] 				= $this->ReadPropertyString("deviceTopic")."/cmnd/".$command;
        $data['Payload'] 			= strval($value);
        $dataJSON 					= json_encode($data,JSON_UNESCAPED_SLASHES);
		$this->SendDebug("Sende", "Command: ".$command." - Value: ".$value, 0);
        $this->SendDataToParent($dataJSON);
	}
	
	public function RequestAction($ident, $value) 
	{
		//IPS_LogMessage("RequestAction", print_r($ident));
		switch($ident)
		{
			default :
				$this->SetValue($ident, $value);
			break;
			case "stateBM" :
				$command 	= "setStateBM";
				$getCommand = "getStateBM";
				switch($value)
				{
					case 0 : 	$value = '00';break;
					case 1 : 	$value = '01';break;
					case 2 : 	$value = '02';break;
					case 3 : 	$value = '03';break;
					case 4 : 	$value = '04';break;
					case 5 : 	$value = '05';break;
					case 14 :	$value = '0e';break;
				}
				$this->SetValue("stateBM", 99);
			break;
			case "curTimePrg" :
				$command 	= "setCurTimePrg";
				$getCommand = "getCurTimePrg";
				switch($value)
				{
					case 0 : 	$value = '00';break;
					case 1 : 	$value = '01';break;
					case 2 : 	$value = '02';break;
				}
				$this->SetValue("curTimePrg", 99);
			break;
			case "actWeekplan":
				switch($value)
				{
					case 0 : 	
						IPS_SetEventActive($this->GetIDForIdent("heatplan1"), true);
						IPS_SetEventActive($this->GetIDForIdent("heatplan2"), false);
						IPS_SetEventActive($this->GetIDForIdent("heatplan3"), false);
					break;
					case 1 : 
						IPS_SetEventActive($this->GetIDForIdent("heatplan1"), false);
						IPS_SetEventActive($this->GetIDForIdent("heatplan2"), true);
						IPS_SetEventActive($this->GetIDForIdent("heatplan3"), false);
					break;
					case 2 :
						IPS_SetEventActive($this->GetIDForIdent("heatplan1"), false);
						IPS_SetEventActive($this->GetIDForIdent("heatplan2"), false);
						IPS_SetEventActive($this->GetIDForIdent("heatplan3"), true);
					break;
				}
				$this->WSet('hw', 3);
				$this->SetValue("actWeekplan", $value);
			break;
			case "setActualMod":
				$this->WSet('hw', 3);
				$this->SetValue("setActualMod", false);
			break;
		}
	
		if(isset($command) && $command != "")
		{
			$this->SendCMD($command, $value);
		}
		if(isset($getCommand) && $getCommand != "")
		{
			$this->SendCMD($getCommand, "");
		}		
	}
}
?>