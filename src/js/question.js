export default function Question(type) {

    this.title = type;
    this.question = '';
    this.menu = false;
    this.elapsedTime = 0;
    this.obligatory = false;
    this.transparent = '#616161';

    switch (type) {
        case 'Radiobutton':
            this.icon = 'radio_button_checked';
            this.options = [
                {
                    label: '',
                    checked: false
                },
                {
                    label: '',
                    checked: false
                }
            ];
        break;
        case 'Checkmark':
            this.icon = 'check_box';
            this.options = [
                    {
                        label: '',
                        checked: false
                    },
                    {
                        label: '',
                        checked: false
                    }
                ];
        break;
        case 'Textfield':
            this.value = '';
            this.icon = 'text_fields';
        break;
        case 'Textarea':
            this.labelText = '';
            this.value = '';
            this.icon = 'check_box_outline_blank';
        break;
        case 'Date':
            this.icon = 'date_range';
        break;
        case 'Time':
            this.icon = 'access_time';
        break;
        case 'Slider':
            this.icon = 'linear_scale';
            this.value = 0;
        break;
        case 'Image':
            this.icon = 'photo';
            this.src = '';
            this.showUrl = true;
        break;
        case 'Video':
            this.icon = 'personal_video';
            this.src = '';
            this.showUrl = true;
        break;
        case 'Select':
            this.icon = 'arrow_drop_down';
            this.src = '';
            this.showUrl = true;
            this.options = [
                    {
                        text: 'a'
                    },
                    {
                        text: 'b'
                    }
                ];
        break;
        default:
            console.error(
                'No such question type exists'
                + '\n Available options: '
                + '\n- "Radiobutton"'
                + '\n- "Checkmark"'
                + '\n- "Textfield"'
                + '\n- "Textarea"'
                + '\n- "Date"'
                + '\n- "Time"'
                + '\n- "Slider"'
            )
    }
}
