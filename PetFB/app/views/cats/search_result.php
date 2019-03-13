<div class='mt-5 '>
    <table class='table table-hover'>
        <thead>
        <tr>
            <th>Name</th>
            <th>Gender</th>
            <th>Age</th>
            <th>Breed</th>
            <th>Color</th>
            <th colspan="2">Area</th>
            <th>Marital</th>
            <th>View</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($data['search_result'] as $cat_search)
        {
            echo "<tr>
                    <th>" . $cat_search->catName. "</th>
                    <th>" . $cat_search->gender . "</th>
                    <th>" . $cat_search->age . "</th>
                    <th>" . $cat_search->breed . "</th>
                    <th>" . $cat_search->color . "</th>
                    <th>".  $cat_search->province. "</th>
                    <th>" . $cat_search->city . "</th>
                    <th>";
                            if ($cat_search->marital==2) {
                                echo "YES";
                            } else {
                                echo "NO";
                            }
            echo "<th><a href='".URL_ROOT."/cats/search_detail/".$cat_search->catId."'
                       class='btn btn-primary btn-block'>View</a>
                </tr>";
        } ?>
        </tbody>
    </table>
</div>