<?php
/**
 * 验证类
 * User: zhangweiwei
 * Date: 15/7/22
 * Time: 下午9:53
 */
class regexTool
{
    private $validate = [
        'required' => '/.+/',
       // 'email' => '/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+$/',
       // 'url' => '',
        'qq' => '/^\d{5,11}$/',
        'mobile' => '/^1(3|4|5|7|8)\d{9}$/',
        'english' => '/^[A-Za-z]+$/',
        'zip' => '/^\d{6}$/',
        'number' => '/^\d+$/',
        'integer' => '/^[-\+]?\d+$/',
        'double' => '/^[-\+]?\d+(\.\d+)?$/',
        'currency' => '/^\d(\.\d+)?$/',

    ];

    //匹配结果
    private $returnMatchResult = false;

    //定义修正模式
    private $fixMode = null;

    //存储匹配结果数组
    private $matches = array();

    //是否匹配成功
    private $isMatch = false;


    /**
     * 初始化参数
     * @param bool $returnMatchResult
     * @param null $fixMode
     */
    public function __construct($returnMatchResult = false, $fixMode = null)
    {
        $this->returnMatchResult = $returnMatchResult;
        $this->fixMode = $fixMode;
    }

    private function regex($pattern, $subject)
    {
        if(array_key_exists(strtolower($pattern), $subject)) {
            $pattern = $this->validate[$pattern].$this->fixMode;
        }

        $this->returnMatchResult ?
            preg_match_all($pattern, $subject, $this->matches) :
            $this->isMatch = preg_match_all($pattern, $subject) === 1;
        return $this->getRegexResult();
    }

    /**
     * 确定匹配结果
     * @return array|bool
     *
     */
    private function getRegexResult()
    {
        if($this->returnMatchResult) {
            return $this->matches;
        } else {
            return $this->isMatch;
        }
    }

    /**
     * 切换返回类型的
     * @param null $bool
     */
    public function toggleReturnType($bool = null)
    {
        if(empty($bool)) {
            $this->returnMatchResult = !$this->returnMatchResult;
        } else {
            $this->returnMatchResult = is_bool($bool) ? $bool : (bool)$bool;
        }
    }


    /**
     * 设置修正模式   在初始化时错过初始化修正模式时，可以在此设置
     * @param $fixMode
     */
    public function setFixMode ($fixMode)
    {
        $this->fixMode = $fixMode;
    }

    /**
     * 用户自定义匹配
     * @param $pattern
     * @param $subject
     * @return array|bool
     */
    public function check($pattern, $subject)
    {
        return $this->regex($pattern, $subject);
    }



}