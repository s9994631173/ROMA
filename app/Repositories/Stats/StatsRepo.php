<?php 
namespace App\Repositories\Stats;
use App\Models\Clicks;
use App\Models\Logins;

class StatsRepo{
    public function stats(){
        $result = Clicks::select('date', Clicks::raw("count(login) as 'ALL',
        count(distinct login) as 'UNIQ',
    
        count(case when module='Страхование' then login end) as 'insurance',
        count(distinct case when module='Страхование' then login end) as 'uniqInsurance',
    
        count(case when module='КЦ' then login end) as 'cc',
        count(distinct case when module='КЦ' then login end) as 'uniqCc',
    
        count(case when module='ОГ' then login end) as 'og',
        count(distinct case when module='ОГ' then login end) as 'uniqOg',
    
        count(case when module='Упаковка' then login end) as 'pack',
        count(distinct case when module='Упаковка' then login end) as 'uniqPack',
    
        count(case when module='Импорт' then login end) as 'import',
        count(distinct case when module='Импорт' then login end) as 'uniqImport'
        "))->groupBy('date')->orderBy('date', 'DESC')->paginate(30);
    
        // count of new users by date. Append to result array
        for($i=0; $i<count($result); $i++){
            $result[$i]['appendUsers'] = Logins::where('date', '=', $result[$i]['date'])->count();
        }
    
        $allUsers = Logins::count();
        return ['data' => $result, 'allUsers' => $allUsers];
    
        return view('stats', ['data' => $result, 'allUsers' => $allUsers]);
    }
}

