function search_attr(o)
{
    var name = o.name;
    // alert(name);
    $('#'+name).submit();
}

function delete_attr(o)
{
    var name = o.id;
    // alert(name);
    $('#delete_'+name).submit();
}