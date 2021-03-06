<?php

//******************************************************************************
//                                       characterize.php
//
// Author(s): Morgane Vidal <morgane.vidal@inra.fr>
// PHIS-SILEX version 1.0
// Copyright © - INRA - 2018
// Creation date: 27 juin 2018
// Contact: morgane.vidal@inra.fr, anne.tireau@inra.fr, pascal.neveu@inra.fr
// Last modification date:  27 juin 2018
// Subject:
//******************************************************************************

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\date\DatePicker;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $sensor app\models\YiiSensorModel */

$this->title = Yii::t('app', 'Characterize Sensor');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '{n, plural, =1{Sensor} other{Sensors}}', ['n' => 2]), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sensor-create">
    <h1><?= Html::encode($this->title) ?> - <?= $sensor->label ?></h1>
    <script>
        $(document).ready(function() {
            $('.characterize-form > form').yiiActiveForm('init', []);
        })
        
        var rdfType = "<?= $sensor->rdfType ?>";
        var inputLabels = {};
        
        /**
         * Add the given field to the list of the required fields for the current sensor type
         * label is used to display error message
         * @param string name 
         * @param string label
         */
        function addRequiredField(name, label) {
            $('.characterize-form > form').yiiActiveForm('add', {
                id: name,
                name: name,
                container: "#input-container-" + name,
                input: "[name=" + name + "]"
            });   
            
            inputLabels[name] = label;
        }    
        
        /**
         * Add the given list of fields to the list of the required fields for the current sensor type
         * label is used to display error message
         * N is the number of fields occurence
         * @param string name 
         * @param string label
         * @param int count
         */
        function addRequiredFieldGroup(groupName, label, count) {
            for (var i = 1; i <= count; i++) {
                var name = groupName + i;
                $('.characterize-form > form').yiiActiveForm('add', {
                    id: name,
                    name: name,
                    container: "#input-container-" + groupName,
                    input: "[name=" + name + "]"
                });   
                
                inputLabels[name] = label;
            }
        }            
        
        var requiredMessage = "<?= Yii::t('yii', '{attribute} cannot be blank.') ?>";
        
        /**
         * Validate fields declared to be required
         * @params ...fieldNames list of all fields name to check
         * @returns {Boolean} True if all fields in the list are filled
         *                    false otherwise
         */
        function checkRequiredFields() {
            var emptyFields = false;
            
            for (var i = 0; i < arguments.length; i++) {
                var fieldName = arguments[i];
                
                var fieldValue = $('[name=' + fieldName + ']').val();
                var isEmpty = (fieldValue === null) || (fieldValue === "");
                
                emptyFields = emptyFields || isEmpty;
                console.log(fieldName, fieldValue, isEmpty)
                if (isEmpty) {
                    var message = requiredMessage.replace("{attribute}", inputLabels[fieldName]);
                    $('.characterize-form > form').yiiActiveForm('updateAttribute', fieldName, [message]);
                }
            }
            
            return !emptyFields;
        }
        
        /**
         * Validate field group declared to be required
         * @param string groupName
         * @param int count
         * @returns {Boolean} true if every field in the group are filled
         *                    false otherwise
         */
        function checkRequiredFieldGroup(groupName, count) {
            var emptyFields = false;
            var fieldName = "";
            
            for (var i = 1; i <= count; i++) {
                fieldName = groupName + i;
                
                var fieldValue = $('[name=' + fieldName + ']').val();
                var isEmpty = (fieldValue === null) || (fieldValue === "");
                
                emptyFields = emptyFields || isEmpty;
            }
            
            if (emptyFields) {
                for (var i = 1; i <= count; i++) {
                    fieldName = groupName + i;
                    var message = requiredMessage.replace("{attribute}", inputLabels[fieldName]);
                    $('.characterize-form > form').yiiActiveForm('updateAttribute', fieldName, [message]);
                }
            }
            
            return !emptyFields;
        }
        
        /**
         * Validates that the required fields for a camera sensor are filled.
         * List of the required params : height, width, pixelSize
         * @returns {Boolean} true if the required field are filled
         *                    false if required fields are missing
         */
        function validateCamera() {
           return checkRequiredFields("height", "width", "pixelSize");
        }

        /**
         * Validates that the required fields for a multispectral camera sensor are filled.
         * List of the required params : wavelength, focalLength, attenuatorFilter x6
         * @returns {Boolean} true if the required field are filled
         *                    false if required fields are missing
         */
        function validateMultispectralCamera() {
            var wavelengthValid = checkRequiredFieldGroup("wavelength", 6);
            var focalLengthValid = checkRequiredFieldGroup("focalLength", 6);
            var attenuatorFilterValid = checkRequiredFieldGroup("attenuatorFilter", 6);
            
            return wavelengthValid
                && focalLengthValid
                && attenuatorFilterValid;
        }

        /**
         * Validates that the required fields for a lens are filled.
         * List of the required params : lensLabel, lensBrand, lensPersonInCharge,
         *                               lensInServiceDate, lensFocalLength, lensAperture
         * @returns {Boolean} true if the required field are filled
         *                    false if required fields are missing
         */
        function validateLens() {
            return checkRequiredFields(
                "lensLabel", 
                "lensBrand", 
                "lensPersonInCharge",
                "lensInServiceDate",
                "lensFocalLength",
                "lensAperture"
            );            
        }

        /**
         * Validates that the required fields for a TIR Camera are filled.
         * List of the required params : waveband
         * @returns {Boolean} true if the required field are filled
         *                    false if required fields are missing
         */
        function validateTIRCamera() {
            var lensValidation = validateLens();
            return checkRequiredFields("waveband") && lensValidation;
        }

        /**
         * Validates that the required fields for a LiDAR are filled.
         * List of the required params : wavelength, scanningAngularRange
         * @returns {Boolean} true if the required field are filled
         *                    false if required fields are missing
         */
        function validateLiDAR() {
            return checkRequiredFields(
                "wavelength", 
                "scanningAngularRange",
                "scanAngularResolution",
                "spotWidth",
                "spotHeight"
            );                 
        }

        /**
         * Validates that the required fields for a Spectrometer are filled.
         * List of the required params : halfFieldOfView, minWavelength,
         *                               maxWavelength, spectralSamplingInterval
         * @returns {Boolean} true if the required field are filled
         *                    false if required fields are missing
         */
        function validateSpectrometer() {
            return checkRequiredFields(
                "halfFieldOfView", 
                "minWavelength",
                "maxWavelength",
                "spectralSamplingInterval"
            );                 
        }

        /**
         * Validate that the required fields of the form are filled
         * @returns {Boolean} true if the required field are filled
         *                    false if required fields are missing
         */
        function validateRequiredFields() {
            // Validate required fields
            var validation = true;
            if (rdfType === "<?= Yii::$app->params["Camera"] ?>"
                    || rdfType === "<?= Yii::$app->params["HemisphericalCamera"] ?>"
                    || rdfType === "<?= Yii::$app->params["HyperspectralCamera"] ?>"
                    || rdfType === "<?= Yii::$app->params["MultispectralCamera"] ?>"
                    || rdfType === "<?= Yii::$app->params["RGBCamera"] ?>"
                    || rdfType === "<?= Yii::$app->params["TIRCamera"] ?>") {
                if (!validateCamera()) {
                    validation = false;
                }

                if (rdfType === "<?= Yii::$app->params["MultispectralCamera"] ?>") {
                    if (!validateMultispectralCamera()) {
                        validation = false;
                    }
                }
                if (rdfType === "<?= Yii::$app->params["RGBCamera"] ?>") {
                    if (!validateLens()) {
                        validation = false;
                    }
                }
                if (rdfType === "<?= Yii::$app->params["TIRCamera"] ?>") {
                    if (!validateTIRCamera()) {
                        validation = false;
                    }
                }
            } else if (rdfType === "<?= Yii::$app->params["LiDAR"] ?>") {
                if (!validateLiDAR()) {
                    validation = false;
                }
            } else if (rdfType === "<?= Yii::$app->params["Spectrometer"] ?>") {
                if (!validateSpectrometer()) {
                    validation = false;
                }
            }

            return validation;
        }
    </script>

    <?php 
        /**
         * This function generate HTML and JS validation script for an input markup used to characterize sensor
         * @param string $name    input name
         * @param string $label   displayed label
         * @param string $type    input type @see https://developer.mozilla.org/fr/docs/Web/HTML/Element/Input
         * @param string $step    optional step attribute for input type number @see https://developer.mozilla.org/fr/docs/Web/HTML/Element/Input/number#step
         * @param string $unit    optional displayed unit (added to label)
         * @return string HTML and JS code generated
         */
        function createValidatedInput($name, $label, $type, $step = null, $unit = null) {
            $toReturn = '<div id="input-container-' . $name . '" class="form-group">';
            $completeLabel = $label;
            if ($unit != null) {
                $completeLabel .=  ' (' . $unit . ') ';
            }
            $toReturn .= Html::label($completeLabel . '<font color="red">*</font>', $name, ['class' => 'control-label']);
            
            $attributes = [
                'type' => $type, 
                'class' => 'form-control'
            ];
            if ($step != null) {
                $attributes['step'] = $step;
            }
            
            $toReturn .= Html::textInput($name, null, $attributes);
            $toReturn .= '<div class="help-block"></div>';
            $toReturn .= <<<EOT
                <script>
                    $(document).ready(function() {
                        addRequiredField("$name", "$label");
                    })
                </script>
EOT;
            $toReturn .= '</div>';
            
            return $toReturn;
        }

        /**
         * This function generate HTML and JS validation script for N input markup used to characterize sensor
         * @param string $name    input name
         * @param type $count     number of input to generate
         * @param string $label   displayed label
         * @param string $type    input type @see https://developer.mozilla.org/fr/docs/Web/HTML/Element/Input
         * @param string $step    optional step attribute for input type number @see https://developer.mozilla.org/fr/docs/Web/HTML/Element/Input/number#step
         * @param string $unit    optional displayed unit (added to label)
         * @param type $extraText optional extra text displayed after label and unit
         * @return string HTML and JS code generated
         */        
        function createValidatedInputTableRow($name, $count, $label, $type, $step = null, $unit = null, $extraText = "") {
            $toReturn = '<tr id="input-container-' . $name . '" class="form-group">';
            $completeLabel = $label;
            if ($unit != null) {
                $completeLabel .=  ' (' . $unit . ') ';
            }            
            $toReturn .= '<th scope="row">' . $completeLabel .'<font color="red">*</font>' . $extraText . '<div class="help-block"></div></th>';
            
            $attributes = [
                'type' => $type, 
                'class' => 'form-control'
            ];
            if ($step != null) {
                $attributes['step'] = $step;
            }
            
            for ($i = 1; $i <= $count; $i++) {
                $toReturn .= '<td>' . Html::textInput($name . $i, null, $attributes) . '</td>';
            }
                        
            $toReturn .= <<<EOT
                <script>
                    $(document).ready(function() {
                        addRequiredFieldGroup("$name", "$label", $count);
                    })
                </script>
EOT;
                        
            $toReturn .= '</tr>';
            
            return $toReturn;
        }
    ?>

    <!-- Generated form for the current sensor type, all required field are check before submitting form -->
    <div class="characterize-form well" onSubmit="return validateRequiredFields();">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'uri')->hiddenInput(['value'=> $sensor->uri])->label(false); ?>
        
        <?php if ($sensor->rdfType === Yii::$app->params["Camera"]
                 || $sensor->rdfType ===Yii::$app->params["HemisphericalCamera"]
                 || $sensor->rdfType === Yii::$app->params["HyperspectralCamera"]
                 || $sensor->rdfType === Yii::$app->params["MultispectralCamera"]
                 || $sensor->rdfType === Yii::$app->params["RGBCamera"]
                 || $sensor->rdfType === Yii::$app->params["TIRCamera"]): ?>
            <script>
         
            </script>
            <div class="characterize-attributes" id="camera">
                <?= createValidatedInput('height', Yii::t('app', 'Height'), 'number', 1, 'pixels') ?>
                <?= createValidatedInput('width', Yii::t('app', 'Width'), 'number', 1, 'pixels') ?>
                <?= createValidatedInput('pixelSize', Yii::t('app', 'Pixel Size'), 'number', 'any', 'µm') ?>
            </div>
        <?php endif; ?>
        
        <?php if ($sensor->rdfType === Yii::$app->params["MultispectralCamera"]): ?>
            <div id="wavelengthMS">
                <table class="table table-hover">
                    <thead>
                    <tr>
                      <th scope="col"></th>
                      <th scope="col">1</th>
                      <th scope="col">2</th>
                      <th scope="col">3</th>
                      <th scope="col">4</th>
                      <th scope="col">5</th>
                      <th scope="col">6</th>
                    </tr>
                    <tbody>
                        <?= createValidatedInputTableRow('wavelength', 6, Yii::t('app', 'Wavelength'), 'number', 'any', 'nm'); ?>
                        <?= createValidatedInputTableRow('focalLength', 6, Yii::t('app', 'Focal Length'), 'number', 'any', 'mm'); ?>
                        <?= createValidatedInputTableRow('attenuatorFilter', 6, Yii::t('app', 'Attenuator Filter'), 'number', 'any', '%', ' [0 - 100]'); ?>
                    </tbody>
                  </thead>
                </table>
            </div>
        <?php endif; ?>
        
        <?php if ($sensor->rdfType === Yii::$app->params["TIRCamera"]): ?>
            <div id="waveband">
                <?= createValidatedInput('waveband', Yii::t('app', 'Waveband'), 'number', 'any', 'nm') ?>
            </div>
        <?php endif; ?>
        
        <?php if ($sensor->rdfType === Yii::$app->params["RGBCamera"]
                 || $sensor->rdfType === Yii::$app->params["TIRCamera"]): ?>
            <div id="lens">

                <h3><?= Yii::t('app', 'Lens') ?> <font color="red">*</font></h3>
                <hr>

                <?= createValidatedInput('lensLabel', Yii::t('app', 'Label'), 'text') ?>

                <?= createValidatedInput('lensBrand', Yii::t('app', 'Brand'), 'text') ?>

                <div id="input-container-lensPersonInCharge" class="form-group">
                    <?= Html::label(Yii::t('app', 'Person In Charge') . ' <font color="red">*</font>', 'lensPersonInCharge', ['class' => 'control-label']) ?>
                    <?= Select2::widget([
                        'name' => 'lensPersonInCharge',
                        'data' => $users,
                        'options' => [
                            'id' => 'lensPersonInCharge',
                            'multiple' => false,
                            'prompt' => ''],
                        'pluginOptions' => [
                            'allowClear' => false,
                        ],
                    ]); ?>
                    <div class="help-block"></div>
                    <script>
                        $(document).ready(function() {
                            addRequiredField("lensPersonInCharge", "Person In Charge");
                        })
                    </script>
                </div>
                
                <div id="input-container-lensInServiceDate" class="form-group">
                    <?= Html::label(Yii::t('app', 'In Service Date') . ' <font color="red">*</font>', 'lensInServiceDate', ['class' => 'control-label']) ?>
                    <?= DatePicker::widget([
                        'name' => 'lensInServiceDate',
                        'options' => [
                            'placeholder' => Yii::t('app/messages','Enter in service date'),
                            'id' => 'lensInServiceDate'],
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => 'yyyy-mm-dd'
                        ]
                    ]); ?>
                    <div class="help-block"></div>
                    <script>
                        $(document).ready(function() {
                            addRequiredField("lensInServiceDate", "In Service Date");
                        })
                    </script>
                </div>


                <?= createValidatedInput('lensFocalLength', Yii::t('app', 'Focal Length'), 'number', 'any', 'mm') ?>

                <?= createValidatedInput('lensAperture', Yii::t('app', 'Aperture'), 'number', 'any', 'fnumber') ?>
            </div>
        <?php endif; ?>
        
        <?php if ($sensor->rdfType === Yii::$app->params["LiDAR"]): ?>
            <div id="lidar">
                <?= createValidatedInput('wavelength', Yii::t('app', 'Wavelength'), 'number', 'any', 'nm') ?>

                <?= createValidatedInput('scanningAngularRange', Yii::t('app', 'Scanning Angular Range'), 'number', 'any', '°') ?>

                <?= createValidatedInput('scanAngularResolution', Yii::t('app', 'Scan Angular Resolution'), 'number', 'any', '°') ?>

                <?= createValidatedInput('spotWidth', Yii::t('app', 'Spot width'), 'number', 'any', '°') ?>

                <?= createValidatedInput('spotHeight', Yii::t('app', 'Spot height'), 'number', 'any', '°') ?>
            </div>
        <?php endif; ?>
        
        <?php if ($sensor->rdfType === Yii::$app->params["Spectrometer"]): ?>        
            <div id="spectrometer">
                <?= createValidatedInput('halfFieldOfView', Yii::t('app', 'Half Field Of View'), 'number', 'any', '°') ?>

                <?= createValidatedInput('minWavelength', Yii::t('app', 'Minimum Wavelength'), 'number', 'any', 'nm') ?>

                <?= createValidatedInput('maxWavelength', Yii::t('app', 'Maximum Wavelength'), 'number', 'any', 'nm') ?>

                <?= createValidatedInput('spectralSamplingInterval', Yii::t('app', 'number', 'any', 'Spectral Sampling Interval')) ?>
            </div>
        <?php endif; ?>
        
        <?php if ($sensor->rdfType !== Yii::$app->params["Camera"]
                 && $sensor->rdfType !==Yii::$app->params["HemisphericalCamera"]
                 && $sensor->rdfType !== Yii::$app->params["HyperspectralCamera"]
                 && $sensor->rdfType !== Yii::$app->params["MultispectralCamera"]
                 && $sensor->rdfType !== Yii::$app->params["RGBCamera"]
                 && $sensor->rdfType !== Yii::$app->params["TIRCamera"]
                 && $sensor->rdfType !== Yii::$app->params["LiDAR"]
                 && $sensor->rdfType !== Yii::$app->params["Spectrometer"]): ?>
            <div id="noCharacterization">
                <p> <?= Yii::t('app/messages', 'The selected sensor cannot be characterized. Please select another sensor among cameras (all camera types : RGB, multispectral, etc.), spectrometers and LiDAR.') ?></p>
            </div>
        <?php else: ?>
            <br/>
            <?= Html::submitButton(Yii::t('app', 'Characterize'), ['class' => 'btn btn-success']) ?>
        <?php endif; ?>

        <?= Html::a(Yii::t('app', 'Back to sensor view'), ["sensor/view", "id" => $sensor->uri],['class' => 'btn btn-info']) ?>
            
        <?php ActiveForm::end(); ?>
    </div>

</div>