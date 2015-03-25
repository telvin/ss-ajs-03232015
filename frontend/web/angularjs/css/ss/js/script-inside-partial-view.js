<!-- Add checklist-->

$(function() {

    var items = [];
    $.each($('#actions-list span'), function(index,item){
        var _item = new Object();
        _item['text'] = $(item).attr('text');
        _item['value'] = $(item).attr('value');
        _item['name'] = $(item).attr('parse-name');
        _item['prefix_id'] = $(item).attr('parse-id');
        _item['checked'] = $(item).attr('parse-checked');

        items.push(_item);
    });

//    var items = [{text: 'Onion', value: '1'},
//        {text: 'Ketchup', value: '2'},
//        {text: 'Mayonnaise', value: '3'},
//        {text: 'Pickles', value: '4'},
//        {text: 'Tomato', value: '5'},
//        {text: 'Patatoes', value: '6'},
//        {text: 'Sausage', value: '7'},
//        {text: 'Lettuce', value: '8'},
//        {text: 'Pepper', value: '9'}
//    ];

    var isCheckAll = Boolean($('#actions-list').attr('setCheckAll'));
    $('.checklist-container').checkList({
        listItems: items,
        onChange: selChange,
        defaultChecked: isCheckAll
    });



    function selChange(){
        var selection = $('.checklist-container').checkList('getSelection');

        //$('#selectedItems').text(JSON.stringify(selection));
    }

//        $('#populate').click(function(){
//            var bevs =  [{text: 'Coca Cola', value: '1'},
//                {text: 'Pepsi', value: '2'},
//                {text: 'Sprite', value: '3'},
//                {text: 'Fanta', value: '4'},
//                {text: 'Dr Pepper', value: '5'},
//                {text: 'Mineral Water', value: '6'},
//                {text: 'Tea', value: '7'},
//                {text: 'Ice-tea', value: '8'},
//                {text: 'Ayran', value: '9'}
//            ];
//            $('.checklist-container').checkList('setData', bevs);
//        });
});

